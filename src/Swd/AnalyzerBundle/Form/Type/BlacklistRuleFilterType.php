<?php

/**
 * Shadow Daemon -- Web Application Firewall
 *
 *   Copyright (C) 2014-2015 Hendrik Buchwald <hb@zecure.org>
 *
 * This file is part of Shadow Daemon. Shadow Daemon is free software: you can
 * redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, version 2.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Swd\AnalyzerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlacklistRuleFilterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->setMethod('GET')
			->setAction('#')
			->add('ruleId', 'integer', array('required' => false, 'label'  => 'Rule ID'))
			->add('profileId', 'integer', array('required' => false, 'label'  => 'Profile ID'))
			->add('status', 'choice', array('required' => false, 'choices' => array('1' => 'Active', '2' => 'Inactive', '3' => 'Pending')))
			->add('searchCallers', 'bootstrap_collection', array('allow_add' => true, 'allow_delete' => true, 'label' => 'Caller'))
			->add('searchPaths', 'bootstrap_collection', array('allow_add' => true, 'allow_delete' => true, 'label' => 'Path'))
			->add('dateStart', 'datetime', array('required' => false, 'label'  => 'From', 'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day', 'hour' => 'Hour', 'minute' => 'Minute')))
			->add('dateEnd', 'datetime', array('required' => false, 'label'  => 'To', 'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day', 'hour' => 'Hour', 'minute' => 'Minute')))
			->add('ignoreCallers', 'bootstrap_collection', array('allow_add' => true, 'allow_delete' => true, 'label' => 'Caller'))
			->add('ignorePaths', 'bootstrap_collection', array('allow_add' => true, 'allow_delete' => true, 'label' => 'Path'))
			->add('actions', 'form_actions', array('buttons' => array('filter' => array('type' => 'submit'), 'reset' => array('type' => 'reset'))));
	}

	public function getName()
	{
		return 'blacklist_rule_filter';
	}

	/**
	 * CSRF protection is useless for searching and makes it impossible
	 * to send urls with filters to other persons, so better disable it.
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(
			array(
				'csrf_protection' => false
			)
		);
	}
}
