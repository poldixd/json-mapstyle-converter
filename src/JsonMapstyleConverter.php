<?php

namespace poldixd\JsonMapstyleConverter;

class JsonMapstyleConverter {

    public function convert($json): string
    {
        $json = json_decode($json);

        $_items = [];
        $separator = '|';
        $_parameters = '';

        foreach ($json as $key => $value) {

            $hasFeature = isset($value->featureType);
            $hasElement = isset($value->elementType);
            $stylers = $value->stylers;
            $target = '';
            $style = '';

            if (! $hasFeature && ! $hasElement){
                $target = 'feature:all';
            } else {
                if ($hasFeature){
                    $target = 'feature:' . $value->featureType;
                }
                if ($hasElement){
                    $target = $target ? $target . $separator : '';
                    $target .= 'element:' . $value->elementType;
                }
            }

            foreach ($stylers as $stylerKey => $stylerValue) {
                $styleItem = $stylerValue;
                $key = array_keys((array) $styleItem)[0]; // there is only one per element

                $style = $style ? $style . $separator : '';
                $style .= $key . ':' . ($this->isColor($styleItem->{$key}) ? $this->toColor($styleItem->{$key}) : $styleItem->{$key});
            }

            $_items[] = $target . $separator . $style;

        }

        return '&style=' . join('&style=', $_items);
    }

    protected function isColor($color): Bool
    {
        $color = str_replace('#', '', $color);
        return (ctype_xdigit($color) && strlen($color) == 6);
    }

    protected function toColor($color): String
    {
        return '0x' . str_replace('#', '', $color);
    }
}