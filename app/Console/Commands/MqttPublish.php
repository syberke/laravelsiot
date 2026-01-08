<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;

class MqttPublish extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'mqtt:publish';

    /**
     * The console command description.
     */
    protected $description = 'Publish MQTT message';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mqtt = new MqttClient(
            config('mqtt.host'),
            config('mqtt.port'),
            'laravel_publisher_' . rand(1000, 9999)
        );

        $settings = (new ConnectionSettings)
            ->setUsername(config('mqtt.username'))
            ->setPassword(config('mqtt.password'))
            ->setKeepAliveInterval(30);

        $mqtt->connect($settings, true);

        $mqtt->publish(
            'test/topic',
            json_encode([
                'nama_sensor' => 'Suhu',
                'data'        => rand(25, 35),
            ]),
            0
        );


        $mqtt->disconnect();

        $this->info('Message published!');
    }
}
