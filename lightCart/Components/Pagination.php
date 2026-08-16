<?php
class Pagination
{
    private $max = 10;
    private $index = 'page';
    private $current_page;
    private $total;
    private $limit;
    private $pattern;
    private $amount;

    public function __construct(int $total, int $currentPage, int $limit, string $index, array $pattern)
    {
        $this->total        = $total;
        $this->limit        = $limit;
        $this->index        = $index;
        $this->pattern      = $pattern;
        $this->amount       = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function get(): string
    {
        $links = '';
        [$start, $end] = $this->limits();
        $html = '<div class="pagenavi_ins">';

        for ($page = $start; $page <= $end; $page++) {
            $links .= ($page === $this->current_page)
                ? '<span class="current" data-page="' . $page . '">' . $page . '</span>'
                : $this->generateHtml($page);
        }

        if ($links !== '') {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, '&lt;') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, '&gt;');
            }
        }

        $html .= $links . '<div class="clear"></div></div>';
        return $html;
    }

    private function generateHtml(int $page, ?string $text = null): string
    {
        $text = $text ?? $page;
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace($this->pattern, '', $currentURI);
        return '<a href="' . $currentURI . $this->index . $page . '" rel="next" data-page="' . $page . '">' . $text . '</a>';
    }

    private function limits(): array
    {
        $left = $this->current_page - round($this->max / 2);
        $start = max(1, $left);
        $end = min($start + $this->max - 1, $this->amount);

        if ($end - $start + 1 < $this->max) {
            $start = max(1, $end - $this->max + 1);
        }

        return [$start, $end];
    }

    private function setCurrentPage(int $currentPage): void
    {
        $this->current_page = max(1, min($currentPage, $this->amount));
    }

    private function amount(): int
    {
        return (int) ceil($this->total / $this->limit);
    }
}
