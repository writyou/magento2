<?php
/**
 * Encapsulates directories structure of a Magento module
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Module;

class Dir
{
    /**
     * Directory registry
     *
     * @var \Magento\App\Dir
     */
    protected $_applicationDirs;

    /**
     * @var \Magento\Stdlib\String
     */
    protected $_string;

    /**
     * @param \Magento\App\Dir $applicationDirs
     * @param \Magento\Stdlib\String $string
     */
    public function __construct(\Magento\App\Dir $applicationDirs, \Magento\Stdlib\String $string)
    {
        $this->_applicationDirs = $applicationDirs;
        $this->_string = $string;
    }

    /**
     * Retrieve full path to a directory of certain type within a module
     *
     * @param string $moduleName Fully-qualified module name
     * @param string $type Type of module's directory to retrieve
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getDir($moduleName, $type = '')
    {
        $result = $this->_applicationDirs->getDir(\Magento\App\Dir::MODULES)
            . DIRECTORY_SEPARATOR
            . $this->_string->upperCaseWords($moduleName, '_', DIRECTORY_SEPARATOR);
        if ($type) {
            if (!in_array($type, array('etc', 'sql', 'data', 'i18n', 'view'))) {
                throw new \InvalidArgumentException("Directory type '$type' is not recognized.");
            }
            $result .= DIRECTORY_SEPARATOR . $type;
        }
        return $result;
    }
}
