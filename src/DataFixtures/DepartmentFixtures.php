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

    public function __construct()
    {
        $depts = array();
        $depts["01"] = "Ain";
        $depts["02"] = "Aisne";
        $depts["03"] = "Allier";
        $depts["04"] = "Alpes de Haute Provence";
        $depts["05"] = "Hautes Alpes";
        $depts["06"] = "Alpes Maritimes";
        $depts["07"] = "Ardèche";
        $depts["08"] = "Ardennes";
        $depts["09"] = "Ariège";
        $depts["10"] = "Aube";
        $depts["11"] = "Aude";
        $depts["12"] = "Aveyron";
        $depts["13"] = "Bouches du Rhône";
        $depts["14"] = "Calvados";
        $depts["15"] = "Cantal";
        $depts["16"] = "Charente";
        $depts["17"] = "Charente Maritime";
        $depts["18"] = "Cher";
        $depts["19"] = "Corrèze";
        $depts["2A"] = "Corse du Sud";
        $depts["2B"] = "Haute Corse";
        $depts["21"] = "Côte d'Or";
        $depts["22"] = "Côtes d'Armor";
        $depts["23"] = "Creuse";
        $depts["24"] = "Dordogne";
        $depts["25"] = "Doubs";
        $depts["26"] = "Drôme";
        $depts["27"] = "Eure";
        $depts["28"] = "Eure et Loir";
        $depts["29"] = "Finistère";
        $depts["30"] = "Gard";
        $depts["31"] = "Haute Garonne";
        $depts["32"] = "Gers";
        $depts["33"] = "Gironde";
        $depts["34"] = "Hérault";
        $depts["35"] = "Ille et Vilaine";
        $depts["36"] = "Indre";
        $depts["37"] = "Indre et Loire";
        $depts["38"] = "Isère";
        $depts["39"] = "Jura";
        $depts["40"] = "Landes";
        $depts["41"] = "Loir et Cher";
        $depts["42"] = "Loire";
        $depts["43"] = "Haute Loire";
        $depts["44"] = "Loire Atlantique";
        $depts["45"] = "Loiret";
        $depts["46"] = "Lot";
        $depts["47"] = "Lot et Garonne";
        $depts["48"] = "Lozère";
        $depts["49"] = "Maine et Loire";
        $depts["50"] = "Manche";
        $depts["51"] = "Marne";
        $depts["52"] = "Haute Marne";
        $depts["53"] = "Mayenne";
        $depts["54"] = "Meurthe et Moselle";
        $depts["55"] = "Meuse";
        $depts["56"] = "Morbihan";
        $depts["57"] = "Moselle";
        $depts["58"] = "Nièvre";
        $depts["59"] = "Nord";
        $depts["60"] = "Oise";
        $depts["61"] = "Orne";
        $depts["62"] = "Pas de Calais";
        $depts["63"] = "Puy de Dôme";
        $depts["64"] = "Pyrénées Atlantiques";
        $depts["65"] = "Hautes Pyrénées";
        $depts["66"] = "Pyrénées Orientales";
        $depts["67"] = "Bas Rhin";
        $depts["68"] = "Haut Rhin";
        $depts["69"] = "Rhône";
        $depts["70"] = "Haute Saône";
        $depts["71"] = "Saône et Loire";
        $depts["72"] = "Sarthe";
        $depts["73"] = "Savoie";
        $depts["74"] = "Haute Savoie";
        $depts["75"] = "Paris";
        $depts["76"] = "Seine Maritime";
        $depts["77"] = "Seine et Marne";
        $depts["78"] = "Yvelines";
        $depts["79"] = "Deux Sèvres";
        $depts["80"] = "Somme";
        $depts["81"] = "Tarn";
        $depts["82"] = "Tarn et Garonne";
        $depts["83"] = "Var";
        $depts["84"] = "Vaucluse";
        $depts["85"] = "Vendée";
        $depts["86"] = "Vienne";
        $depts["87"] = "Haute Vienne";
        $depts["88"] = "Vosges";
        $depts["89"] = "Yonne";
        $depts["90"] = "Territoire de Belfort";
        $depts["91"] = "Essonne";
        $depts["92"] = "Hauts de Seine";
        $depts["93"] = "Seine St Denis";
        $depts["94"] = "Val de Marne";
        $depts["95"] = "Val d'Oise";
        $depts["97"] = "DOM";
        $this->depts = $depts;
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
