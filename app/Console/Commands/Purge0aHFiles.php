<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class Purge0aHFiles
 *
 * @package App\Console\Commands
 */
class Purge0aHFiles extends Command
{
    protected $checkedFiles;
    protected $deletedFiles;
    protected $description = 'Recursively removes all files beginning with 0aH within the fileRemovalTest folder.';
    protected $matchingFiles;
    protected $noConfirm = false;
    protected $purge0aHFilesUtility;
    protected $silent = false;
    protected $signature = 'purge-0aH-files
                                             {--no-confirm : automatically delete all matching files without verification}
                                             {--silent : automatically delete all matching files without verification and suppress all output}';

    public function __construct(\App\Utilities\Console\Commands\Purge0aHFiles $purge0aHFilesUtility)
    {
        $this->purge0aHFilesUtility = $purge0aHFilesUtility;

        $this->checkedFiles = collect([]);
        $this->deletedFiles = collect([]);
        $this->matchingFiles = collect([]);

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->checkOptions();

        $this->matchingFiles = $this->purge0aHFilesUtility->findMatchingFiles();
        $this->checkedFiles = $this->purge0aHFilesUtility->getCheckedFiles();

        $this->outputIfShould($this->fetchScanSummaryText());

        $this->matchingFiles->each(function ($matchingFile) {
            $this->processMatchingFile($matchingFile);
        });

        $this->outputIfShould($this->fetchDeletionSummaryText());
    }

    /**
     * @param \SplFileInfo $matchingFile
     */
    protected function processMatchingFile(\SplFileInfo $matchingFile): void
    {
        if ($this->fetchShouldDelete($matchingFile)) {
            $this->deletedFiles->push($matchingFile);
            $this->purge0aHFilesUtility->deleteFile($matchingFile);

            $this->warnIfShould($this->fetchDeleteFileConfirmationMessageText($matchingFile->getPathname()));
        }
    }

    /**
     * @param \SplFileInfo $matchingFile
     *
     * @return bool
     */
    protected function fetchShouldDelete(\SplFileInfo $matchingFile): bool
    {
        if ($this->noConfirm === true) {
            return true;
        }

        $confirmationMessage = $this->fetchDeletedFileConfirmationMessageText($matchingFile->getPathname());

        return $this->confirm($confirmationMessage);
    }

    /**
     * @param string $pathName
     *
     * @return string
     */
    protected function fetchDeleteFileConfirmationMessageText(string $pathName): string
    {
        return trans('console/commands/purge_0aH_files.confirm_file_deletion_prompt', [
            'fileName' => $pathName,
        ]);
    }

    /**
     * @param string $pathName
     *
     * @return string
     */
    protected function fetchDeletedFileConfirmationMessageText(string $pathName): string
    {
        return trans('console/commands/purge_0aH_files.deleted', [
            'fileName' => $pathName,
        ]);
    }

    /**
     *
     */
    protected function checkOptions(): void
    {
        if ($this->option('no-confirm') === true) {
            $this->noConfirm = true;
        }

        if ($this->option('silent') === true) {
            $this->noConfirm = true;
            $this->silent = true;
        }
    }

    /**
     * @param string $text
     */
    protected function outputIfShould(string $text): void
    {
        if ($this->silent === false) {
            $this->output->text($text);
        }
    }

    /**
     * @param string $text
     */
    protected function warnIfShould(string $text): void
    {
        if ($this->silent === false) {
            $this->warn($text);
        }
    }

    /**
     * @return string
     */
    protected function fetchScanSummaryText(): string
    {
        return trans('console/commands/purge_0aH_files.scan_summary', [
            'matchingFilesCount' => number_format($this->matchingFiles->count()),
            'totalFilesCount' => number_format($this->checkedFiles->count()),
        ]);
    }


    /**
     * @return string
     */
    protected function fetchDeletionSummaryText(): string
    {
        if (count($this->deletedFiles) === 0) {
            return trans('console/commands/purge_0aH_files.no_deletion_summary', [
                'totalFilesCount' => number_format(count($this->checkedFiles)),
            ]);
        }

        return trans('console/commands/purge_0aH_files.scan_summary', [
            'deletedFilesCount' => number_format(count($this->deletedFiles)),
            'totalFilesCount' => number_format(count($this->checkedFiles)),
        ]);
    }
}
