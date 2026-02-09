<?php
/**
 * HopeCMS(希望CMS)
 * @author LinZiChen <271106735@qq.com>
 * @link https://www.hopecms.cn
 * @copyright 2024-2025 HopeCMS All rights reserved.
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
require_once 'system/base.php';

$emDispatcher = Dispatcher::getInstance();
$emDispatcher->dispatch();
View::output();