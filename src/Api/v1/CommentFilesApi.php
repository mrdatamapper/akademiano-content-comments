<?php


namespace Akademiano\Content\Comments\Api\v1;


use Akademiano\Attach\Api\v1\LinkedFilesApi;
use Akademiano\Content\Comments\Model\CommentFile;

class CommentFilesApi extends LinkedFilesApi
{
    const API_ID = "commentFilesApi";
    const ENTITY_CLASS = CommentFile::class;
}

