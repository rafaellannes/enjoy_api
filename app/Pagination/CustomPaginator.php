<?php

namespace App\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class CustomPaginator extends LengthAwarePaginator
{

    public function nextPage()
    {
        if ($this->hasMorePages()) {
            return $this->currentPage() + 1;
        }
    }

    public function previousPage()
    {
        if ($this->currentPage() > 1) {
            return $this->currentPage() - 1;
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'current_page' => $this->currentPage(),
            'data' => $this->items->toArray(),
            'first_page_url' => $this->url(1),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'last_page_url' => $this->url($this->lastPage()),
            /*  'links' => $this->linkCollection()->toArray(), */
            'next_page_url' => $this->nextPage(),
            /*  'path' => $this->path(), */
            'per_page' => $this->perPage(),
            'prev_page_url' => $this->previousPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),
        ];
    }
}
