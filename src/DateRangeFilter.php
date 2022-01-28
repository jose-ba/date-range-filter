<?php

namespace Jose1987ba\DateRangeFilter;

public function filterByDates(array $arrayToFilter, DateTime $filterStartDate, DateTime $filterEndDate): array
{
    return array_filter($arrayToFilter, function ($item) use ($filterStartDate, $filterEndDate) {
        $itemStartDate = $item->getStartDate();
        $itemEndDate = $item->getEndDate();

        if ($filterStartDate > $itemEndDate || $filterEndDate < $itemStartDate) {
            return false;
        }

        // Se solapa con el inicio
        if ($filterStartDate <= $itemStartDate && $filterEndDate <= $itemEndDate) {
            return true;
        }

        // Ambas fechas del filtro dentro de las fechas de la formación
        if ($filterStartDate >= $itemStartDate && $filterEndDate <= $itemEndDate) {
            return true;
        }

        // Se solapa con el fin
        if ($filterStartDate >= $itemStartDate && $filterEndDate >= $itemEndDate) {
            return true;
        }

        // Las fechas del filtro engloban a las de la formación
        if ($filterStartDate <= $itemStartDate && $filterEndDate >= $itemEndDate) {
            return true;
        }

        return false;
    });
}