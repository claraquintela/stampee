<?php


function countdown($temps)
{
    // Define a data final do leilão (exemplo: 31 de dezembro de 2024, às 23:59:59)
    $end_date = strtotime('$temps');

    // Calcula o tempo restante até o fim do leilão
    $now = time();
    $time_left = $end_date - $now;

    // Formata o tempo restante em dias, horas, minutos e segundos
    $days = floor($time_left / (60 * 60 * 24));
    $hours = floor(($time_left % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($time_left % (60 * 60)) / 60);
    $seconds = $time_left % 60;

    // Exibe o tempo restante
    return "<span>$days jour $hours : $minutes : $seconds </span>";
}
