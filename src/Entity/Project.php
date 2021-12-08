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
     * @ORM\Column(type="integer")
     */
    private int $group_number;

    /**
     * @ORM\Column(type="integer")
     */
    private int $student_number;

    /**
     * @ORM\OneToMany(targetEntity=Group::class, mappedBy="project", orphanRemoval=true)
     */
    private $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function getGroupNumber(): int
    {
        return $this->group_number;
    }

    public function setGroupNumber(int $group_number): self
    {
        $this->group_number = $group_number;

        return $this;
    }

    public function getStudentNumber(): int
    {
        return $this->student_number;
    }

    public function setStudentNumber(int $student_number): self
    {
        $this->student_number = $student_number;

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
            $group->setProject($this);
        }

        return $this;
    }

    public function removeGroup(Group $group): self
    {
        if ($this->groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getProject() === $this) {
                $group->setProject(null);
            }
        }

        return $this;
    }
}
