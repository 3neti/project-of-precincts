<?php

namespace LBHurtado\ProjectOfPrecincts\Contracts;

use LBHurtado\ProjectOfPrecincts\Domain\ProjectOfPrecincts;
use LBHurtado\ProjectOfPrecincts\Domain\SourceManifest;

interface PrecinctSourceImporter
{
    public function import(SourceManifest $manifest): ProjectOfPrecincts;
}
