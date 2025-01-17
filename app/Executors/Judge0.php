<?php

namespace App\Executors;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class Judge0 extends Executor
{
    public static function execute(string $code, string $language): array
    {
        $key = md5($code.$language);

        $response = Cache::remember($key, 60 * 60, function () use ($code, $language) {
            return self::runSubmission($code, $language);
        });

        return [
            'output' => $response['stdout'],
            'error' => $response['stderr'],
        ];
    }

    public static function runSubmission(string $code, string $language): array
    {
        $response = self::createSubmission($code, $language);

        $token = $response['token'];

        do {
            usleep(2.5 * 1000000);
            $response = self::fetchSubmission($token);
        } while ($response['status']['id'] < 3);

        return $response;
    }

    public static function createSubmission(string $code, string $language): array
    {
        $languageId = match ($language) {
            'javascript' => 63,
            'r' => 80,
            default => throw new InvalidArgumentException("Unsupported language: {$language}"),
        };

        $response = self::makeRequest()
            ->post('https://judge0-ce.p.rapidapi.com/submissions', [
                'source_code' => $code,
                'language_id' => $languageId,
            ]);

        return $response->json();
    }

    public static function fetchSubmission(string $token): array
    {
        $response = self::makeRequest()
            ->get("https://judge0-ce.p.rapidapi.com/submissions/{$token}");

        return $response->json();
    }

    protected static function makeRequest(): PendingRequest
    {
        return Http::createPendingRequest()
            ->throw()
            ->withHeaders([
                'Content-Type' => 'application/json',
                'x-rapidapi-host' => 'judge0-ce.p.rapidapi.com',
                'x-rapidapi-key' => '7c9db85545msh9f5f296775a9affp195290jsne84d67476563',
            ]);
    }
}
