<?php

namespace App\Decorator;

use App\Decorator\Contract\TaskParserDelegate;
use App\Decorator\Contract\TaskRequestDelegate;

/**
 * Interface TaskDecoratorContractImp
 * @package App\Decorator
 */
interface TaskDecoratorContractImp extends TaskParserDelegate, TaskRequestDelegate
{

}
