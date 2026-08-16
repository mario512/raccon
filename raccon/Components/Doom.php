<?php
class Doom
{
    private $title       = '';
    private $description = '';
    private $scripts     = [];
    private $styles      = [];
    private $links       = [];

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function addScript(string $src, bool $defer = true): void
    {
        $this->scripts[] = ['src' => $src, 'defer' => $defer];
    }

    public function getScripts(): array
    {
        return $this->scripts;
    }

    public function addStyle(string $href): void
    {
        $this->styles[] = $href;
    }

    public function getStyles(): array
    {
        return $this->styles;
    }

    public function addLink(string $rel, string $href): void
    {
        $this->links[] = ['rel' => $rel, 'href' => $href];
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}
