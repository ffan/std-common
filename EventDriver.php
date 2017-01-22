<?php
namespace ffan\php\utils;

use ffan\php\event\EventManager;

/**
 * Class EventDriver 事件驱动
 * 由于PHP的析构函数非常诡异，不可用于业务
 * @package ffan\php\utils
 */
class EventDriver
{
    /** 最大优先级 */
    const MAX_PRIORITY = 100000;
    
    /** commit事件 */
    const EVENT_COMMIT = 'commit';

    /** 回滚事件 */
    const EVENT_ROLLBACK = 'rollback';

    /** 处理结束 */
    const EVENT_EXIT = 'exit';

    /**
     * @var bool 是否注册shutdown_function
     */
    private static $is_register = false;

    /**
     * @var int 析造优先级
     */
    protected $exit_priority = 0;

    /**
     * Destruct constructor. 构造函数
     */
    public function __construct()
    {
        $event = EventManager::instance();
        $event->attach(self::EVENT_EXIT, [$this, '__exit'], $this->exit_priority);
        if (!self::$is_register) {
            self::$is_register = true;
            register_shutdown_function(array(__CLASS__, 'shutdown'));
        }
    }

    /**
     * 资源回收，类的属性已经可安全使用，不由于__destruct，destruct时属性可能提前__destruct了
     */
    public function __exit()
    {

    }

    /**
     * shutdown_function
     */
    public static function shutdown()
    {
        $event = EventManager::instance();
        $event->trigger(self::EVENT_EXIT);
    }

    /**
     * 手动设置退出优化级
     * @param int $priority 优先级
     */
    public function setExitPriority($priority = 0)
    {
        if ($priority < 0) {
            $priority = 0;
        } elseif ($priority >= self::MAX_PRIORITY) {
            $priority = self::MAX_PRIORITY;
        }
        $event = EventManager::instance();
        $this->exit_priority = $priority;
        $callback = [$this, '__exit'];
        //先移除事件，重新设置事件优先级，有优化空间
        $event->detach(EventDriver::EVENT_EXIT, $callback);
        $event->attach(EventDriver::EVENT_EXIT, $callback, $this->exit_priority);
    }

    /**
     * 手动设置退出优化级
     */
    public function getExitPriority()
    {
        return $this->exit_priority;
    }
}