<?php

namespace Geow\NotFoundMonitor\Livewire;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\View;
use Laravel\Pulse\Facades\Pulse;
use Laravel\Pulse\Livewire\Card;
use Laravel\Pulse\Livewire\Concerns\RemembersQueries;
use Laravel\Pulse\Livewire\Concerns\HasPeriod;
use Livewire\Attributes\Lazy;

class NotFoundMonitor extends Card
{
    use HasPeriod;
    use RemembersQueries;

    #[Lazy]
    public function render(): Renderable
    {
        [$notFoundPages, $time, $runAt] = $this->remember(
            fn () => Pulse::aggregate(
                'page_not_found',
                'count',
                $this->periodAsInterval(),
                'count',
            )->map(function ($row) {
                [$method, $uri] = json_decode($row->key, flags: JSON_THROW_ON_ERROR);

                return (object) [
                    'uri' => $uri,
                    'method' => $method,
                    'count' => $row->count,
                ];
            }),
        );

        return View::make('404-monitor::livewire.404-monitor', [
            'notFoundPages' => $notFoundPages,
        ]);
    }
}
