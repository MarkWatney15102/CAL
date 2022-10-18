<?php

declare(strict_types=1);

namespace lib\Controller;

use Exception;
use JsonException;
use lib\Database\Database;
use lib\Form\AbstractForm;
use lib\Message\Message;
use lib\Message\MessageGroup;
use lib\Model\AbstractEntity;
use lib\Template\Template;

abstract class AbstractController implements ControllerInterface
{
    protected Database $database;
    protected AbstractForm $form;
    protected array $urlParams;

    public function render(string $view, array $args = []): void
    {
        if (!empty($_COOKIE['message'])) {
            MessageGroup::getInstance()?->addMessage(Message::INFO, 'Info', $_COOKIE['message']);
            setcookie('message', "", -1, "/");
        }

        $template = (!isset($args['renderWithBasicBody']) || (bool)$args['renderWithBasicBody'] === false) ? new Template(false) : new Template();

        $path = $_SERVER['DOCUMENT_ROOT'] . '/views/' . $view . '.php';

        $template->setContent($path);
        $template->render($args);
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function renderJson(string|array $jsonData): void
    {
        $type = gettype($jsonData);
        $jsonString = match ($type) {
            'string' => $jsonData,
            'array' => json_encode($jsonData, JSON_THROW_ON_ERROR),
            default => throw new Exception('Invalid type'),
        };

        echo $jsonString;
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    public function setUrlParams(array $urlParams): void
    {
        $this->urlParams = $urlParams;
    }
}
