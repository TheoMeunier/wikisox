<?php

namespace App\Services;

class EditorjsParser
{
    public function parser(string $json): string
    {
        $data = json_decode($json, true, 512, JSON_OBJECT_AS_ARRAY);
        $html = '';

        foreach ($data['blocks'] as $block) {
            switch ($block['type']) {
                case 'paragraph':
                    $html .= $this->parse_paragraphe($block['data']['text']);
                    break;
                case 'header':
                    $html .= $this->parser_header($block);
                    break;
                case 'quote':
                    $html .= $this->parse_blockquote($block);
                    break;
                case 'list':
                    $html .= $this->parse_list($block);
                    break;
                case 'code':
                    $html .= $this->parse_code($block);
                    break;
                case 'warning':
                    $html .= $this->parse_warning($block);
                    break;
            }
        }

        return $html;
    }

    private function parse_paragraphe(string $text): string
    {
        return '<p>'.$text.'</p>';
    }

    private function parser_header(mixed $block): string
    {
        return '<h'.$block['data']['level'].'>'.$block['data']['text'].'</h'.$block['data']['level'].'>';
    }

    private function parse_blockquote(mixed $block): string
    {
        $text    = $block['data']['text'];
        $caption = ! empty($block['data']['caption']) ? $block['data']['caption'] : '';

        $html = '<blockquote class="editor-quote">';
        $html .= '<p>'.$text.'</p>';

        if (! empty($caption)) {
            $html .= '<small>- '.$caption.'</small>';
        }

        $html .= '</blockquote>';

        return $html;
    }

    private function parse_list(mixed $list): string
    {
        $html = '';

        $style = $list->data->style === 'ordered' ? 'ol' : 'ul';
        $items = $list->data->items;

        $html .= "<$style>";

        foreach ($items as $item) {
            $subItems = $item['items'] ?? [];

            $html .= '<li>';

            $html .= $item['content'];

            if (! empty($subItems)) {
                $html .= $this->parse_list($subItems);
            }

            $html .= '</li>';
        }

        $html .= "</$style>";

        return $html;
    }

    private function parse_code(mixed $block): string
    {
        return '<pre><code class="'.$block['data']['language'].'">'.$block['data']['code'].'</code></pre>';
    }

    private function parse_warning(mixed $block): string
    {
        $html = '';

        $html .= '<div class="warning">';
        $html .= '<strong>'.$block['data']['title'].'</strong>';
        $html .= '<p>'.$block['data']['message'].'</p>';
        $html .= '</div>';

        return $html;
    }
}
