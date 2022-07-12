<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $technologie;

    #[ORM\ManyToMany(targetEntity: Collaborateurs::class, inversedBy: 'competences')]
    private $competences_collaborateurs;

    #[ORM\OneToMany(mappedBy: 'competences', targetEntity: Projets::class)]
    private $competence_projet;

    public function __construct()
    {
        $this->projet_competence = new ArrayCollection();
        $this->competences_collaborateurs = new ArrayCollection();
        $this->competence_projet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTechnologie(): ?string
    {
        return $this->technologie;
    }

    public function setTechnologie(string $technologie): self
    {
        $this->technologie = $technologie;

        return $this;
    }

    /**
     * @return Collection<int, Collaborateurs>
     */
    public function getCompetencesCollaborateurs(): Collection
    {
        return $this->competences_collaborateurs;
    }

    public function addCompetencesCollaborateur(Collaborateurs $competencesCollaborateur): self
    {
        if (!$this->competences_collaborateurs->contains($competencesCollaborateur)) {
            $this->competences_collaborateurs[] = $competencesCollaborateur;
        }

        return $this;
    }

    public function removeCompetencesCollaborateur(Collaborateurs $competencesCollaborateur): self
    {
        $this->competences_collaborateurs->removeElement($competencesCollaborateur);

        return $this;
    }

    /**
     * @return Collection<int, Projets>
     */
    public function getCompetenceProjet(): Collection
    {
        return $this->competence_projet;
    }

    public function addCompetenceProjet(Projets $competenceProjet): self
    {
        if (!$this->competence_projet->contains($competenceProjet)) {
            $this->competence_projet[] = $competenceProjet;
            $competenceProjet->setCompetences($this);
        }

        return $this;
    }

    public function removeCompetenceProjet(Projets $competenceProjet): self
    {
        if ($this->competence_projet->removeElement($competenceProjet)) {
            // set the owning side to null (unless already changed)
            if ($competenceProjet->getCompetences() === $this) {
                $competenceProjet->setCompetences(null);
            }
        }

        return $this;
    }
}
