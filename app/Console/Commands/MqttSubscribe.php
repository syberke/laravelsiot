<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use App\Models\Sensor;

class MqttSubscribe extends Command
{
    protected $signature = 'mqtt:subscribe';
    protected $description = 'Subscribe MQTT topic';

    public function handle()
    {
        $mqtt = new MqttClient(
            config('mqtt.host'),
            config('mqtt.port'),
            config('mqtt.client_id')
        );

        $settings = (new ConnectionSettings)
            ->setUsername(config('mqtt.username'))
            ->setPassword(config('mqtt.password'))
            ->setKeepAliveInterval(30);

        $mqtt->connect($settings, true);

        $this->info('MQTT Connected');

        $mqtt->subscribe('test/topic', function ($topic, $message) {

            // HARUS JSON
            $payload = json_decode($message, true);

            if (!$payload) {
                $this->error('Message bukan JSON');
                return;
            }

            Sensor::create([
                'nama_sensor' => $payload['nama_sensor'],
                'data'        => $payload['data'],
            ]);

            $this->info("Data masuk: {$payload['nama_sensor']} = {$payload['data']}");
        }, 0);

        $mqtt->loop(true);
    }
}
