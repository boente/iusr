<?php

namespace App\Executors;

use App\Models\Language;
use Filament\Forms;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Judge0 extends Executor
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = [
            ...$config,
            'endpoint' => 'https://'.$config['host'],
        ];
    }

    public function fields(): array
    {
        return [
            Forms\Components\Select::make('data.judge0_id')
                ->label('Judge0 language')
                ->options(collect($this->getLanguages())->pluck('name', 'id'))
                ->required(),
        ];
    }

    public function execute(string $code, Language $language): array
    {
        $key = md5($code.$language);

        if (Cache::has($key)) {
            sleep(1);
        }

        $response = Cache::remember('judge0-'.$key, 60 * 60, function () use ($code, $language) {
            return $this->runSubmission($code, $language);
        });

        return [
            'output' => $response['stdout'],
            'error' => $response['stderr'],
        ];
    }

    public function runSubmission(string $code, Language $language): array
    {
        $response = $this->createSubmission($code, $language);

        $token = $response['token'];

        do {
            usleep(2.5 * 1000000);
            $response = $this->fetchSubmission($token);
        } while ($response['status']['id'] < 3);

        return $response;
    }

    public function createSubmission(string $code, Language $language): array
    {
        $languageId = $language->data['judge0_id'];

        $response = $this->makeRequest()
            ->post($this->config['endpoint'].'/submissions', [
                'source_code' => $code,
                'language_id' => $languageId,
            ]);

        return $response->json();
    }

    public function fetchSubmission(string $token): array
    {
        $response = $this->makeRequest()
            ->get($this->config['endpoint'].'/submissions/'.$token);

        return $response->json();
    }

    public function getLanguages(): array
    {
        return Cache::rememberForever('judge0-languages', function () {
            $response = $this->makeRequest()->get($this->config['endpoint'].'/languages');

            return $response->json();
        });
    }

    protected function makeRequest(): PendingRequest
    {
        return Http::createPendingRequest()
            ->throw()
            ->withHeaders([
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => $this->config['host'],
                'x-rapidapi-key' => $this->config['api_key'],
            ]);
    }
}
