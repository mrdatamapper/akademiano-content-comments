<?php

namespace Akademiano\Content\Comments\Model;


use Akademiano\Entity\ContentEntity;
use Akademiano\Entity\Entity;
use Akademiano\Entity\EntityInterface;
use Akademiano\Entity\NamedEntityInterface;
use Akademiano\EntityOperator\EntityOperator;
use Akademiano\Operator\DelegatingInterface;
use Akademiano\Operator\DelegatingTrait;
use Akademiano\UserEO\Model\Utils\OwneredTrait;
use Akademiano\Utils\Object\Collection;

/**
 * @method EntityOperator getOperator()
 */
class Comment extends ContentEntity implements NamedEntityInterface, DelegatingInterface
{
    const ENTITY_CLASS = Entity::class;
    const ENTITY_FILES_CLASS = CommentFile::class;

    use DelegatingTrait;
    use OwneredTrait;

    /** @var  Entity */
    protected $entity;

    protected $files;


    /**
     * @return EntityInterface|null
     */
    public function getEntity()
    {
        if (null !== $this->entity && !$this->entity instanceof EntityInterface) {
            $this->entity = $this->getOperator()->get(static::ENTITY_CLASS, $this->entity);
        }
        return $this->entity;
    }

    /**
     * @param Entity $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return Collection|CommentFile[]
     */
    public function getFiles()
    {
        if (!$this->files instanceof Collection) {
            if (is_array($this->files)) {
                $criteria = ["id" => $this->files];
            } else {
                $criteria = ["entity" => $this];
            }
            $this->files = $this->getOperator()->find(static::ENTITY_FILES_CLASS, $criteria);
        }
        return $this->files;
    }
}
