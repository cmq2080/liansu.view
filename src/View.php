<?php

namespace liansu;

use liansu\App;
use liansu\interfaces\IViewHandler;

class View
{
    /**
     * Summary of fetch
     * @param \liansu\interfaces\IViewHandler $viewHandler
     * @param string $reqFile
     * @param array $args
     * @return string
     */
    public function fetch(IViewHandler $viewHandler, $reqFile, $args = [])
    {
        $rawFile = $this->getRawFile($reqFile);
        return $viewHandler->fetch($rawFile, $args);
    }

    public function display(IViewHandler $viewHandler, $reqFile, $args = [])
    {
        $rawFile = $this->getRawFile($reqFile);
        $viewHandler->display($rawFile, $args);
    }

    /**
     *     View        / ViewHandler
     * reqFile->rawFile->tplFile-_>cachedFile
     * @param string $reqFile
     * @return string
     */
    public function getRawFile($reqFile)
    {
        if (!$reqFile) {
            return $this->getDefaultRawFile();
        }

        $reqFile = str_replace_all(['/', '\\', '@'], '/', $reqFile);

        if (strpos($reqFile, '/') === false) { // A => A/
            $reqFile .= '/';
        }

        if (!explode('/', $reqFile)[0]) { // /A => (runner)/A
            $runner = App::instance()->getRunner();
            $reqFile = $runner . $reqFile;
        }

        if (!explode('/', $reqFile)[1]) { // A/ => A/(action)
            $action = App::instance()->getAction();
            $reqFile .= $action;
        }

        return $reqFile;
    }

    /**
     * @return string
     */
    private function getDefaultRawFile()
    {
        $runner = App::instance()->getRunner();
        $baseNamespace = App::instance()->getNamespace();
        $runner = substr($runner, strlen($baseNamespace) + 1); // 要把目录分隔符的位置空出来
        $action = App::instance()->getAction();

        return $runner . '/' . $action;
    }
}
