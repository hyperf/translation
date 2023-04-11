<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Contract\TranslatorInterface;
use Hyperf\Utils\ApplicationContext;
use Hyperf\httpServer\Request;

if (! function_exists('__')) {
    function __(string $key, array $replace = [], ?string $locale = null)
    {
        $translator = ApplicationContext::getContainer()->get(TranslatorInterface::class);
        return $translator->trans($key, $replace, $locale);
    }
}

if (! function_exists('t')) {
    function t(string $key, array $replace = []): string
    {
        $acceptLanguage = ApplicationContext::getContainer()->get(Request::class)->getHeaderLine('accept-language');
        return __($key, $replace, !empty($acceptLanguage) ? explode(',',$acceptLanguage)[0] : 'zh_CN');
    }
}

if (! function_exists('trans')) {
    function trans(string $key, array $replace = [], ?string $locale = null)
    {
        return __($key, $replace, $locale);
    }
}

if (! function_exists('trans_choice')) {
    function trans_choice(string $key, $number, array $replace = [], ?string $locale = null): string
    {
        $translator = ApplicationContext::getContainer()->get(TranslatorInterface::class);
        return $translator->transChoice($key, $number, $replace, $locale);
    }
}
