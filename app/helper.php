<?php

/**
 * @param $state
 * @return string
 */
function translateWithdrawState($state)
{
    switch ($state) {
        case 'success':
            return 'Оплачено';
        case 'error':
            return 'Ошибка';
        case 'in_process':
            return 'Ожидания';
    }
}