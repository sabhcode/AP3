<?php

namespace App\Service;

use App\Entity\Module;
use App\Entity\Section;
use App\Entity\Shelf;
use App\Entity\Way;
use App\Repository\BuildingRepository;
use App\Repository\ModuleRepository;
use App\Repository\SectionRepository;
use App\Repository\ShelfRepository;
use App\Repository\WayRepository;
use Doctrine\ORM\EntityManagerInterface;

class LogisticService {

    public function __construct(private EntityManagerInterface $entityManager,
                                private BuildingRepository $buildingRepository,
                                private ModuleRepository $moduleRepository,
                                private WayRepository $wayRepository,
                                private SectionRepository $sectionRepository)
    {
        $this->entityManager = $entityManager;
    }

    public function addModules(): static {

        for($i = 1; $i <= 15; $i++) {
            for($j = 1; $j <= 6; $j++) {
                $module = new Module();
                $module->setBuilding($this->buildingRepository->find($i));
                $module->setCode('M' . $j);
                $this->entityManager->persist($module);
            }
        }
        $this->entityManager->flush();

        return $this;

    }

    public function addWays(): static {

        $codeWay = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

        for($i = 1; $i <= 90; $i++) {
            foreach($codeWay as $jValue) {
                $way = new Way();
                $way->setModule($this->moduleRepository->find($i));
                $way->setCode($jValue);
                $this->entityManager->persist($way);
            }
        }
        $this->entityManager->flush();

        return $this;

    }

    public function addSections(): static {

        for($i = 1; $i <= 1080; $i++) {
            for($j = 1; $j <= 12; $j++) {
                $section = new Section();
                $section->setWay($this->wayRepository->find($i));
                $section->setCode($j);
                $this->entityManager->persist($section);
            }
        }
        $this->entityManager->flush();

        return $this;

    }

    public function addShelves(): static {

        for($i = 2; $i <= 12960; $i++) {
            for($j = 1; $j <= 8; $j++) {
                $shelf = new Shelf();
                $shelf->setSection($this->sectionRepository->find($i));
                $shelf->setCode($j);
                $this->entityManager->persist($shelf);
            }
        }
        $this->entityManager->flush();

        return $this;

    }

}
