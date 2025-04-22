<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

// Asegúrate de importar tu comando aquí:
use App\Console\Commands\FetchCryptoPrices;

class Kernel extends ConsoleKernel
{
    /**
     * Registrar los comandos Artisan de la aplicación.
     */
    protected $commands = [
        FetchCryptoPrices::class, // Tu comando personalizado
    ];

    /**
     * Definir la programación de tareas de la aplicación.
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejecuta el comando cada hora
        $schedule->command('crypto:fetch-prices')->hourly();
    }

    /**
     * Registrar los comandos para la aplicación.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
