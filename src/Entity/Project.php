<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="project_id", orphanRemoval=true)
     */
    private $groups;

    /**
     * @ORM\Column(type="integer")
     */
    private $group_number;

    #[Pure] public function __construct(string $title, int $group_number)
    {
        $this->title = $title;
        $this->group_number = $group_number;
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Group[]
     */

    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function addGroup(Group $group): self
    {
        if (!$this->groups->contains($group)) {
            $this->groups[] = $group;
            $group->setProjectId($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getProjectId() === $this) {
                $group->setProjectId(null);
            }
        }

        return $this;
    }

    public function getGroupNumber(): ?int
    {
        return $this->group_number;
    }

    public function setGroupNumber(int $group_number): self
    {
        $this->group_number = $group_number;

        return $this;
    }
}
