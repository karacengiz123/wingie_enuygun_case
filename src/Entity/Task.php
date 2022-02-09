<?php

namespace App\Entity;

use App\Exception\InvalidArgumentException;
use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{

    /**
     * Task constructor.
     * @param int|null $id
     * @param string|null $title
     * @param int|null $estimated
     * @param int|null $level
     * @param $developer
     */
    public function __construct(?int $id = null, ?string $title = null, ?int $estimated = null, ?int $level = null, $developer = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->estimated = $estimated;
        $this->level = $level;
        $this->developer = $developer;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $estimated;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @var Developer
     * @ORM\ManyToOne(targetEntity=Developer::class, inversedBy="tasks")
     */
    private $developer;

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

    public function getEstimated(): ?int
    {
        return $this->estimated;
    }

    public function setEstimated(int $estimated): self
    {
        $this->estimated = $estimated;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    /**
     * @param null|Developer $developer
     * @throws InvalidArgumentException
     */
    public function setDeveloper($developer) {
        if($developer === null) {

            if($this->developer !== null) {
                $this->developer->getTasks()->removeElement($this);
            }

            $this->developer = null;
        } else {

            if(!$developer instanceof Developer) {
                throw new InvalidArgumentException('$developer must be null or instance of Developer');
            }

            if($this->developer !== null) {
                $this->developer->getTasks()->removeElement($this);
            }

            $this->developer = $developer;
            $developer->getTasks()->add($this);
        }
    }

    /**
     * @return int
     */
    public function getRealizeEstimate(): int
    {
        return $this->level * $this->estimated;
    }
}
