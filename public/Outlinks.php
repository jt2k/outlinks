<?php
class Outlinks
{
    private $url;
    private $validUrl = false;
    private $scheme;
    private $host;
    private $allowedDomains;

    public function __construct(array $queryParams, array $allowedDomains = [])
    {
        if (isset($queryParams['url'])) {
            $this->url = $queryParams['url'];
            $this->parseUrl();
        }
        $this->allowedDomains = $allowedDomains;
    }

    private function parseUrl()
    {
        $components = parse_url($this->url);
        if (is_array($components) && isset($components['host']) && isset($components['scheme'])) {
            $this->validUrl = true;
            $this->scheme = $components['scheme'];
            $this->host = $components['host'];
        }
    }

    public function isHttps(): bool
    {
        return $this->scheme === 'https';
    }

    public function isValidUrl(): bool
    {
        return $this->validUrl;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function autoRedirect()
    {
        if ($this->isHttps() && in_array($this->host, $this->allowedDomains)) {
            header('Location: ' . $this->url);
            exit;
        }
    }
}
