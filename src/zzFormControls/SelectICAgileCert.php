<?php

namespace Eightfold\LaravelUIKit\FormControls;

use Eightfold\LaravelUIKit\UIKit;

class SelectICAgileCert
{
    static public function build(array $config): string
    {
        $config['options'] = [
            'none' => 'Select ICAgile certification, if appicable',
            'icp' => '(pro) ICAgile Certified Professional - ICP',
            'icp_ent' => '(pro) Agility in the Enterprise - ICP-ENT',
            'icp_cat' => '(pro) Coaching Agile Transitions - ICP-CAT',
            'ice_ec' => '(expert) Enterprise Coaching - ICE-EC',
            'icp_bva' => '(pro) Business Value Analysis - ICP-BVA',
            'icp_evm' => '(pro) Enterprise Value Management - ICP-EVM',
            'ice_vm' => '(expert) Value Management - ICE-VM',
            'icp_apm' => '(pro) Agile Project Management - ICP-APM',
            'icp_ppm' => '(pro) Program and Portfolio Management - ICP-PPM',
            'ice_dm' => '(expert) Delivery Management - ICE-DM',
            'icp_atf' => '(pro) Agile Team Facilitation - ICP-ATF',
            'icp_acc' => '(pro) Agile Coaching - ICP-ACC',
            'ice_ac' => '(expert) Agile Coaching - ICE-AC',
            'icp_prg' => '(pro) Agile Programming - ICP-PRG',
            'icp_asd' => '(pro) Agile Software Design - ICP-ASD',
            'ice_ae' => '(expert) Agile Engineering - ICE-AE',
            'icp_tst' => '(pro) Agile Testing - ICP-TST',
            'icp_ata' => '(pro) Agile Test Automation - ICP-ATA',
            'ice_at' => '(expert) Agile Testing - ICE-AT',
            'icp_fdo' => '(pro) Foundation of DevOps - ICP-FDO',
            'icp_idp' => '(pro) Implementing DevOps (coming soon) - ICP-IDP',
            'ice_do' => '(expert) DevOps - ICE-DO'
        ];
        return UIKit::formselect($config);
    }
}
