<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

		/**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Conference::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $conference;

    /**
     * @ORM\Column(type="string", length=255)
		 * @var string|null
     */
		private $photoName;

		/**
		 * @Vich\UploadableField(mapping="comment_images", fileNameProperty="photoName", size="imageSize")
		 * @var File|null
		 */
		private $photoFile;

		/**
     * @ORM\Column(type="integer")
     *
     * @var int|null
     */
    private $imageSize;
		
		public function __toString(): string
		{
			return (string) $this->getEmail();
		}
		
		public function __construct()
		{
			$this->createdAt = new \DateTime();
			$this->updatedAt = new \DateTime();
		}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getConference(): ?Conference
    {
        return $this->conference;
    }

    public function setConference(?Conference $conference): self
    {
        $this->conference = $conference;

        return $this;
		}
		
		/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $photoFile
     */
		public function setPhotoFile(?File $photoFile = null): void
    {
				$this->photoFile = $photoFile;
				
			if (null !== $photoFile) {
				// It is required that at least one field changes if you are using doctrine
        // otherwise the event listeners won't be called and the file is lo
				$this->updatedAt = new \DateTimeImmutable();
			}
		}

		public function getPhotoFile(): ?File
    {
        return $this->photoFile;
		}

    public function setPhotoName(?string $photoName): void
    {
				$this->photoName = $photoName;
		}

		public function getPhotoName(): ?string
    {
        return $this->photoName;
		}

		public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
