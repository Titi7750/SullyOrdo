<?php

namespace App\Entity;

use App\Repository\ProjetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\CollectionValidator;

#[ORM\Entity(repositoryClass: ProjetsRepository::class)]
class Projets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $date_demarrage;

    #[ORM\Column(type: 'integer')]
    private $reste_a_faire;

    #[ORM\Column(type: 'integer')]
    private $charge_vendu;

    #[ORM\ManyToOne(targetEntity: ChefsProjets::class, inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private $chefs_Projets;

    #[ORM\ManyToMany(targetEntity: Collaborateurs::class, inversedBy: 'projets')]
    private $collaborateurs;

    #[ORM\ManyToOne(targetEntity: Competences::class, inversedBy: 'competence_projet')]
    private $competences;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->collaborateurs = new ArrayCollection();
        $this->competences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDemarrage(): ?\DateTimeInterface
    {
        return $this->date_demarrage;
    }

    public function setDateDemarrage(\DateTimeInterface $date_demarrage): self
    {
        $this->date_demarrage = $date_demarrage;

        return $this;
    }

    public function getResteAFaire()
    {
        return $this->reste_a_faire;
    }

    public function setResteAFaire($reste_a_faire): self
    {
        $this->reste_a_faire = $reste_a_faire;

        return $this;
    }

    public function getChargeVendu()
    {
        return $this->charge_vendu;
    }

    public function setChargeVendu($charge_vendu): self
    {
        $this->charge_vendu = $charge_vendu;

        return $this;
    }

    public function getChefsProjets(): ?ChefsProjets
    {
        return $this->chefs_Projets;
    }

    public function setChefsProjets(?ChefsProjets $chefs_Projets): self
    {
        $this->chefs_Projets = $chefs_Projets;

        return $this;
    }

    public function removeProjet(ProjetsRepository $projetsRepository): self
    {
        $this->projetsRepository->removeElement($projetsRepository);

        return $this;
    }

    public function __toString()
    {
        return $this->deleteProjets . ' ' . $this->getDateDemarrage();
    }

    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    /**
     * @return Collection<int, Collaborateurs>
     */
    public function getCollaborateurs(): Collection
    {
        return $this->collaborateurs;
    }

    public function addCollaborateur(Collaborateurs $collaborateur): self
    {
        if (!$this->collaborateurs->contains($collaborateur)) {
            $this->collaborateurs[] = $collaborateur;
        }

        return $this;
    }

    public function removeCollaborateur(Collaborateurs $collaborateur): self
    {
        $this->collaborateurs->removeElement($collaborateur);

        return $this;
    }
}
