<div>
    <div class="backup-section">
        <h2 class="section-title">Create a Backup File</h2>
        <p class="text">Creating a backup will copy the data stored on a the current system to your own local machine.
            This is done to protect the data from accidental loss or damage due to hardware failure, software
            corruption, or other events.</p>
        <form class="button-container" method="post" action="../../Pages/Settings/Settings.php?page=backupRestore">
            <button class="add-button" type="submit" name="create_backup">
                <ion-icon name="document"></ion-icon>
                <p>Create a backup File</p>
            </button>
        </form>
    </div>

    <div class="backup-section">
        <h2 class="section-title">Restore data from a saved backup file</h2>
        <p class="text">Restoring a backup file will recover a previously saved copy of a file or set of files from an
            external sql file. This process is usually done in order to restore lost data due to a system crash or other
            unforeseen event.</p>
        <p class="text">Note!! upon clicking the restore button. the current data will be overwriten, thus it is recommended to make a backup first, before doing so</p>
        <form class="button-container" enctype="multipart/form-data" method="post"
            action="../../Pages/Settings/Settings.php?page=backupRestore">

            <input class="file" required name="backup" type="file">
            <button class="add-button" type="submit" name="restore_backup">
                <ion-icon name="document"></ion-icon>
                <p>Restore Data</p>
            </button>
        </form>
    </div>
</div>