<?php

namespace App\Utilities\Console\Commands;

use Illuminate\Support\Collection;

/**
 * Class Purge0aHFiles
 *
 * @package App\Utilities\Console\Commands
 */
class Purge0aHFiles
{
    /**
     * @var
     */
    protected $checkedFiles;

    /**
     * @var
     */
    protected $matchingFiles;

    /**
     * @var \RecursiveDirectoryIterator
     */
    protected $directoryIterator;

    /**
     * @var \RecursiveIteratorIterator
     */
    protected $iterator;

    /**
     * Purge0aHFiles constructor.
     */
    public function __construct()
    {
        $this->directoryIterator = new \RecursiveDirectoryIterator(base_path('fileRemovalTest'));

        $this->iterator = new \RecursiveIteratorIterator(
            $this->directoryIterator,
            \RecursiveIteratorIterator::SELF_FIRST
        );
    }

    /**
     * @return Collection
     */
    public function findMatchingFiles(): Collection
    {
        $this->checkedFiles = collect([]);
        $this->matchingFiles = collect([]);

        foreach ($this->iterator as $file) {
            $this->processFile($file);
        }

        return $this->matchingFiles;
    }

    public function getCheckedFiles(): Collection
    {
        return $this->checkedFiles;
    }

    /**
     * @param \SplFileInfo $file
     */
    protected function processFile(\SplFileInfo $file): void
    {
        $this->checkedFiles->push($file);

        if (!$file->isFile()) {
            return;
        }

        if ($this->fileNameMatches($file)) {
            $this->matchingFiles->push($file);
        }
    }

    /**
     * @param \SplFileInfo $file
     *
     * @return bool
     */
    protected function fileNameMatches(\SplFileInfo $file): bool
    {
        return substr($file->getFileName(), 0, 3) === '0aH';
    }

    /**
     * @param \SplFileInfo $matchingFile
     */
    public function deleteFile(\SplFileInfo $matchingFile): void
    {
        unlink($matchingFile->getPathName());
    }
}
