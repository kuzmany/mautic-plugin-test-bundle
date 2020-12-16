<?php

/*
 * @copyright   2020 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticPluginTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mautic\ApiBundle\Serializer\Driver\ApiMetadataDriver;
use Mautic\CoreBundle\Doctrine\Mapping\ClassMetadataBuilder;
use Mautic\LeadBundle\Entity\Lead;

class PluginTest
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Lead
     */
    protected $lead;


    public function __construct()
    {
    }

    /**
     * @param ORM\ClassMetadata $metadata
     */
    public static function loadMetadata(ORM\ClassMetadata $metadata)
    {
        $builder = new ClassMetadataBuilder($metadata);
        $builder->setTable('plugintest')
            ->setCustomRepositoryClass(PluginTest::class);
        $builder->addIdColumns(null, null);
        $builder->createManyToOne(
            'lead',
            Lead::class
        )->addJoinColumn('lead_id', 'id', true, false, 'SET NULL')
            ->cascadePersist()
            ->build();
    }


    /**
     * Prepares the metadata for API usage.
     *
     * @param $metadata
     */
    public static function loadApiMetadata(ApiMetadataDriver $metadata)
    {
        $metadata->setGroupPrefix('plugintest')
            ->addListProperties(
                [
                    'id',
                    'lead',
                ]
            )
            ->build();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Lead
     */
    public function getLead(): Lead
    {
        return $this->lead;
    }

    /**
     * @param Lead $lead
     */
    public function setLead(Lead $lead): void
    {
        $this->lead = $lead;
    }

}
