<?php

namespace App\DataFixtures;

use App\AdminBundle\Entity\Department;
use Doctrine\Common\Persistence\ObjectManager;

class DepartmentFixtures extends BaseFixture
{
    /**
     * Var Array
     */
    private $depts;

    /**
     * Var Array
     */
    private $keys;

    /**
     * Var Array
     */
    private $values;

    public function __construct(){
        $depts = array();
        $this->depts["01"] = "Ain";
        $this->depts["02"] = "Aisne";
        $this->depts["03"] = "Allier";
        $this->depts["04"] = "Alpes de Haute Provence";
        $this->depts["05"] = "Hautes Alpes";
        $this->depts["06"] = "Alpes Maritimes";
        $this->depts["07"] = "Ardèche";
        $this->depts["08"] = "Ardennes";
        $this->depts["09"] = "Ariège";
        $this->depts["10"] = "Aube";
        $this->depts["11"] = "Aude";
        $this->depts["12"] = "Aveyron";
        $this->depts["13"] = "Bouches du Rhône";
        $this->depts["14"] = "Calvados";
        $this->depts["15"] = "Cantal";
        $this->depts["16"] = "Charente";
        $this->depts["17"] = "Charente Maritime";
        $this->depts["18"] = "Cher";
        $this->depts["19"] = "Corrèze";
        $this->depts["2A"] = "Corse du Sud";
        $this->depts["2B"] = "Haute Corse";
        $this->depts["21"] = "Côte d'Or";
        $this->depts["22"] = "Côtes d'Armor";
        $this->depts["23"] = "Creuse";
        $this->depts["24"] = "Dordogne";
        $this->depts["25"] = "Doubs";
        $this->depts["26"] = "Drôme";
        $this->depts["27"] = "Eure";
        $this->depts["28"] = "Eure et Loir";
        $this->depts["29"] = "Finistère";
        $this->depts["30"] = "Gard";
        $this->depts["31"] = "Haute Garonne";
        $this->depts["32"] = "Gers";
        $this->depts["33"] = "Gironde";
        $this->depts["34"] = "Hérault";
        $this->depts["35"] = "Ille et Vilaine";
        $this->depts["36"] = "Indre";
        $this->depts["37"] = "Indre et Loire";
        $this->depts["38"] = "Isère";
        $this->depts["39"] = "Jura";
        $this->depts["40"] = "Landes";
        $this->depts["41"] = "Loir et Cher";
        $this->depts["42"] = "Loire";
        $this->depts["43"] = "Haute Loire";
        $this->depts["44"] = "Loire Atlantique";
        $this->depts["45"] = "Loiret";
        $this->depts["46"] = "Lot";
        $this->depts["47"] = "Lot et Garonne";
        $this->depts["48"] = "Lozère";
        $this->depts["49"] = "Maine et Loire";
        $this->depts["50"] = "Manche";
        $this->depts["51"] = "Marne";
        $this->depts["52"] = "Haute Marne";
        $this->depts["53"] = "Mayenne";
        $this->depts["54"] = "Meurthe et Moselle";
        $this->depts["55"] = "Meuse";
        $this->depts["56"] = "Morbihan";
        $this->depts["57"] = "Moselle";
        $this->depts["58"] = "Nièvre";
        $this->depts["59"] = "Nord";
        $this->depts["60"] = "Oise";
        $this->depts["61"] = "Orne";
        $this->depts["62"] = "Pas de Calais";
        $this->depts["63"] = "Puy de Dôme";
        $this->depts["64"] = "Pyrénées Atlantiques";
        $this->depts["65"] = "Hautes Pyrénées";
        $this->depts["66"] = "Pyrénées Orientales";
        $this->depts["67"] = "Bas Rhin";
        $this->depts["68"] = "Haut Rhin";
        $this->depts["69"] = "Rhône";
        $this->depts["70"] = "Haute Saône";
        $this->depts["71"] = "Saône et Loire";
        $this->depts["72"] = "Sarthe";
        $this->depts["73"] = "Savoie";
        $this->depts["74"] = "Haute Savoie";
        $this->depts["75"] = "Paris";
        $this->depts["76"] = "Seine Maritime";
        $this->depts["77"] = "Seine et Marne";
        $this->depts["78"] = "Yvelines";
        $this->depts["79"] = "Deux Sèvres";
        $this->depts["80"] = "Somme";
        $this->depts["81"] = "Tarn";
        $this->depts["82"] = "Tarn et Garonne";
        $this->depts["83"] = "Var";
        $this->depts["84"] = "Vaucluse";
        $this->depts["85"] = "Vendée";
        $this->depts["86"] = "Vienne";
        $this->depts["87"] = "Haute Vienne";
        $this->depts["88"] = "Vosges";
        $this->depts["89"] = "Yonne";
        $this->depts["90"] = "Territoire de Belfort";
        $this->depts["91"] = "Essonne";
        $this->depts["92"] = "Hauts de Seine";
        $this->depts["93"] = "Seine St Denis";
        $this->depts["94"] = "Val de Marne";
        $this->depts["95"] = "Val d'Oise";
        $this->depts["97"] = "DOM";
        $this->keys = array_keys($this->depts);
        $this->values = array_values($this->depts);
    }
    public function loadData(ObjectManager $manager)
    {
        
        $this->createMany(count($this->depts), "Department", function ($count) {
            $department = new Department();
            $department->setCode($this->keys[$count]);
            $department->setLibelle($this->values[$count]);
            return $department;
        });

        $manager->flush();
    }
}
