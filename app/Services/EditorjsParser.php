<?php

namespace App\Services;

use JsonException;

class EditorjsParser
{
    /**
     * @throws JsonException
     */
    public function parse(string $json): string
    {
        $data = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        $html = '';

        foreach ($data['blocks'] as $block) {
            switch ($block['type']) {
                case 'paragraphe':
                    $html .= $this->parse_paragraphe($block['data']['text']);
                    break;
                case 'header' :
                    $html .= $this->parser_header($block);
                    break;
                case  'quote' :
                    $html .= $this->parse_blockquote($block);
                    break;
                case 'list':
                    $html .= $this->parse_list($block);
                    break;
            }
        }

        return $html;
    }

    private function parse_paragraphe(string $paragraphe): string
    {
        return '<p>' . $paragraphe . '</p>';
    }

    private function parser_header(array $block): string
    {
        return '<h' . $block['data']['level'] . '>' . $block['data']['text'] . '</h' . $block['data']['level'] . '>';
    }

    private function parse_blockquote(array $block): string
    {
        $text = $block['data']['text'];
        $caption = !empty($block['data']['caption']) ? $block['data']['caption'] : '';

        $html = '<blockquote class="editor-quote">';
        $html .= '<p>' . $text . '</p>';

        if (!empty($caption)) {
            $html .= '<small>- ' . $caption . '</small>';
        }

        $html .= '</blockquote>';

        return $html;
    }

    private function parse_list(string $list): string
    {
        $html = '';

        $style = $list['data']['style'] === 'ordered' ? 'ol' : 'ul';
        $html .=  "<{$style}>";

        foreach ($list['data']['items'] as $item) {
            $html .= '<li>';
            $html .= $item['content'];

            if (!empty($item['items'])) {
                $html .= $this->parse_list($item);
            }

            $html .= '</li>';
        }

        $html .= "</{$style}>";

        return $html;
    }
}
