<?php

declare(strict_types=1);

namespace Pest\Stressless;

/**
 * @internal
 *
 * @mixin Result
 */
final class Factory
{
    /**
     * Weather or not the run should be verbose.
     */
    private bool $verbose = false;

    /**
     * The number of concurrent requests.
     */
    private int $concurrency = 1;

    /**
     * The duration of the run in seconds.
     */
    private int $duration = 5;

    /**
     * The HTTP method to use.
     */
    private string $method = 'get';

    /**
     * The payload to send.
     *
     * @var array<string, mixed>
     */
    private array $payload = [];

    /**
     * The computed result, if any.
     */
    private ?Result $result = null;

    /**
     * Creates a new instance of the run factory.
     */
    private function __construct(private readonly string $url)
    {
        //
    }

    /**
     * Creates a new instance of the run factory.
     */
    public static function make(string $url): self
    {
        return new self($url);
    }

    /**
     * Specifies that run should run for the given number of seconds.
     */
    public function duration(int $seconds): self
    {
        assert($seconds > 0, 'The duration must be greater than 0 seconds.');

        $this->duration = $seconds;

        return $this;
    }

    /**
     *  Force the test to use delete method
     */
    public function delete(): self
    {
        $this->method = 'delete';

        return $this;
    }

    /**
     * Force the test to use get method
     */
    public function get(): self
    {
        $this->method = 'get';

        return $this;
    }

    /**
     * Force the test to use head method
     */
    public function head(): self
    {
        $this->method = 'head';

        return $this;
    }

    /**
     * Force the test to use options method
     *
     * @param  array<string, mixed>  $payload  The payload to send with the OPTIONS request
     */
    public function options(array $payload = []): self
    {
        $this->method = 'options';
        $this->payload = $payload;

        return $this;
    }

    /**
     * Force the test to use patch method
     *
     * @param  array<string, mixed>  $payload  The payload to send with the PATCH request
     */
    public function patch(array $payload = []): self
    {
        $this->method = 'patch';
        $this->payload = $payload;

        return $this;
    }

    /**
     * Force the test to use put method
     *
     * @param  array<string, mixed>  $payload  The payload to send with the PUT request
     */
    public function put(array $payload = []): self
    {
        $this->method = 'put';
        $this->payload = $payload;

        return $this;
    }

    /**
     * Force the test to use post method
     *
     * @param  array<string, mixed>  $payload  The payload to send with the POST request
     */
    public function post(array $payload): self
    {
        $this->method = 'post';
        $this->payload = $payload;

        return $this;
    }

    /**
     * Getter for the method property
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * Getter for the payload property
     *
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return $this->payload;
    }

    /**
     * Specifies that run should run with the given number of concurrent requests.
     */
    public function concurrency(int $requests): self
    {
        assert($requests > 0, 'The concurrency must be greater than 0 requests.');

        $this->concurrency = $requests;

        return $this;
    }

    /**
     * Specifies that run should run with the given number of concurrent requests.
     */
    public function concurrently(int $requests): self
    {
        return $this->concurrency($requests);
    }

    /**
     * Specifies that the stage should run for the given duration.
     */
    public function for(int $duration): DurationOptions
    {
        return new DurationOptions($this, $duration);
    }

    /**
     * Creates a new run instance.
     */
    public function run(): Result
    {
        if ($this->result instanceof Result) {
            return $this->result;
        }

        return $this->result = ((new Run(
            new Url($this->url),
            [
                'vus' => $this->concurrency,
                'duration' => sprintf('%ds', $this->duration),
                'method' => $this->method,
                'payload' => $this->payload,
                'throw' => true,
            ],
            $this->verbose,
        ))->start());
    }

    /**
     * Specifies that the run should be verbose, and then exits.
     */
    public function dd(): never
    {
        $this->dump();

        exit(0);
    }

    /**
     * Specifies that the run should be verbose.
     */
    public function dump(): self
    {
        $this->verbosely();

        $this->run();

        return $this;
    }

    /**
     * Specifies that the run should be verbose.
     */
    public function verbosely(): self
    {
        $this->verbose = true;

        return $this;
    }

    /**
     * Forwards calls to the run result.
     *
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $name, array $arguments): mixed
    {
        if (! $this->result instanceof Result) {
            $this->run();
        }

        return $this->result->{$name}(...$arguments); // @phpstan-ignore-line
    }

    /**
     * Forwards property access to the run result.
     */
    public function __get(string $name): mixed
    {
        return $this->{$name}(); // @phpstan-ignore-line
    }
}
