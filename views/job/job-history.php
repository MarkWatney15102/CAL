<div class="alert alert-info job-history" role="alert">
    <b><?= $type ?></b> - <?= $timestamp ?><br>
    <?= $message ?><br>
    <ul class="job-history-actions">
        <li>
            <a href="/job/history/edit/<?= $historyId ?>" title="Bearbeiten">
                <img src="/images/icons/pencil.svg" alt="Edit">
            </a>
        </li>
        <li>
            <a href="/job/history/delete/<?= $historyId ?>" title="Löschen">
                <img src="/images/icons/trash.svg" alt="Delete">
            </a>
        </li>
    </ul>
</div>