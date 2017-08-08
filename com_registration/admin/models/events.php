<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_registration
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @since  0.0.1
 */
class RegistrationModelEvents extends JModelList
{
   /**
    * Constructor.
    *
    * @param   array  $config  An optional associative array of configuration settings.
    *
    * @see     JController
    * @since   1.6
    */
   public function __construct($config = array())
   {
      if (empty($config['filter_fields']))
      {
         $config['filter_fields'] = array(
               'id',
               'name',
               'published'
         );
      }

      parent::__construct($config);
   }

   /**
    * Method to build an SQL query to load the list data.
    *
    * @return      string  An SQL query
    */
   protected function getListQuery()
   {
      // Initialize variables.
      $db = JFactory::getDbo();
      $query = $db->getQuery(true);

      // Create the base select statement.
      $query->select(array('e.*', 'count(p.id) as registered'))
            ->from($db->quoteName('#__registration_events', 'e'));

      $participants_t = $db->quoteName('#__registration_participants', 'p');

      $query->join('LEFT', "$participants_t ON e.id = p.event_id AND p.activation_hash = ''");

      // Filter: like / search
      $search = $this->getState('filter.search');

      if (!empty($search))
      {
         $like = $db->quote('%' . $search . '%');
         $query->where('e.name LIKE ' . $like);
      }

      // Filter by published state
      $published = $this->getState('filter.published');

      if (is_numeric($published))
      {
         $query->where('e.published = ' . (int) $published);
      }
      elseif ($published === '')
      {
         $query->where('(e.published IN (0, 1))');
      }
      $query->group('e.id');

      // Add the list ordering clause.
      $orderCol	= $this->state->get('list.ordering', 'e.name');
      $orderDirn 	= $this->state->get('list.direction', 'asc');

      $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

      return $query;
   }
}