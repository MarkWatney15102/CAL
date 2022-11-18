<?php

class BillsControllerService
{
    public function buildTableBody(array $bills): string
    {
        $return = "";

        foreach ($bills as $bill) {
            if ($bill instanceof Bill) {
                $billId = $bill->getId();
                $billTitle = $bill->getTitle();

                $return .= <<<HTML
                    <tr>
                        <td>{$billId}</td>
                        <td>{$billTitle}</td>
                        <td><a href="/bill/{$billId}" class="btn btn-outline-primary">Öffnen</a></td>
                    </tr>
                HTML;
            }
        }

        return $return;
    }
}