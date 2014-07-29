<?php

namespace Markdown;
use photon\shortcuts;
use Michelf\MarkdownExtra as Markdown;

class Views
{
    public function autodoc($request, $match)
    {
        $file = realpath('doc/' . $match[1] . '.mdtext');
        if (!file_exists($file) || !is_file($file)) {
            throw new \photon\http\error\NotFound();
        }
        $markdown = Markdown::defaultTransform(\file_get_contents($file));
        $params = array(
            'inDoc' => true,
            'content' => $markdown,
        );
        return shortcuts\Template::RenderToResponse('autodoc.html',
                                                    $params,
                                                    $request);
    }
}
