<?php
/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.22.0.5146 modeling language!*/

class Location
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Location Attributes
  private $name;
  private $volume;
  private $mute;

  //Location Associations
  private $locationMusicItems;
  private $homeAudioSystem;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aName, $aVolume, $aMute, $aHomeAudioSystem)
  {
    $this->name = $aName;
    $this->volume = $aVolume;
    $this->mute = $aMute;
    $this->locationMusicItems = array();
    $didAddHomeAudioSystem = $this->setHomeAudioSystem($aHomeAudioSystem);
    if (!$didAddHomeAudioSystem)
    {
      throw new Exception("Unable to create location due to homeAudioSystem");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function setName($aName)
  {
    $wasSet = false;
    $this->name = $aName;
    $wasSet = true;
    return $wasSet;
  }

  public function setVolume($aVolume)
  {
    $wasSet = false;
    $this->volume = $aVolume;
    $wasSet = true;
    return $wasSet;
  }

  public function setMute($aMute)
  {
    $wasSet = false;
    $this->mute = $aMute;
    $wasSet = true;
    return $wasSet;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getVolume()
  {
    return $this->volume;
  }

  public function getMute()
  {
    return $this->mute;
  }

  public function getLocationMusicItem_index($index)
  {
    $aLocationMusicItem = $this->locationMusicItems[$index];
    return $aLocationMusicItem;
  }

  public function getLocationMusicItems()
  {
    $newLocationMusicItems = $this->locationMusicItems;
    return $newLocationMusicItems;
  }

  public function numberOfLocationMusicItems()
  {
    $number = count($this->locationMusicItems);
    return $number;
  }

  public function hasLocationMusicItems()
  {
    $has = $this->numberOfLocationMusicItems() > 0;
    return $has;
  }

  public function indexOfLocationMusicItem($aLocationMusicItem)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->locationMusicItems as $locationMusicItem)
    {
      if ($locationMusicItem->equals($aLocationMusicItem))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getHomeAudioSystem()
  {
    return $this->homeAudioSystem;
  }

  public static function minimumNumberOfLocationMusicItems()
  {
    return 0;
  }

  public function addLocationMusicItemVia()
  {
    return new LocationMusicItem($this);
  }

  public function addLocationMusicItem($aLocationMusicItem)
  {
    $wasAdded = false;
    if ($this->indexOfLocationMusicItem($aLocationMusicItem) !== -1) { return false; }
    $existingLocation = $aLocationMusicItem->getLocation();
    $isNewLocation = $existingLocation != null && $this !== $existingLocation;
    if ($isNewLocation)
    {
      $aLocationMusicItem->setLocation($this);
    }
    else
    {
      $this->locationMusicItems[] = $aLocationMusicItem;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeLocationMusicItem($aLocationMusicItem)
  {
    $wasRemoved = false;
    //Unable to remove aLocationMusicItem, as it must always have a location
    if ($this !== $aLocationMusicItem->getLocation())
    {
      unset($this->locationMusicItems[$this->indexOfLocationMusicItem($aLocationMusicItem)]);
      $this->locationMusicItems = array_values($this->locationMusicItems);
      $wasRemoved = true;
    }
    return $wasRemoved;
  }

  public function addLocationMusicItemAt($aLocationMusicItem, $index)
  {  
    $wasAdded = false;
    if($this->addLocationMusicItem($aLocationMusicItem))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLocationMusicItems()) { $index = $this->numberOfLocationMusicItems() - 1; }
      array_splice($this->locationMusicItems, $this->indexOfLocationMusicItem($aLocationMusicItem), 1);
      array_splice($this->locationMusicItems, $index, 0, array($aLocationMusicItem));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveLocationMusicItemAt($aLocationMusicItem, $index)
  {
    $wasAdded = false;
    if($this->indexOfLocationMusicItem($aLocationMusicItem) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfLocationMusicItems()) { $index = $this->numberOfLocationMusicItems() - 1; }
      array_splice($this->locationMusicItems, $this->indexOfLocationMusicItem($aLocationMusicItem), 1);
      array_splice($this->locationMusicItems, $index, 0, array($aLocationMusicItem));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addLocationMusicItemAt($aLocationMusicItem, $index);
    }
    return $wasAdded;
  }

  public function setHomeAudioSystem($aHomeAudioSystem)
  {
    $wasSet = false;
    if ($aHomeAudioSystem == null)
    {
      return $wasSet;
    }
    
    $existingHomeAudioSystem = $this->homeAudioSystem;
    $this->homeAudioSystem = $aHomeAudioSystem;
    if ($existingHomeAudioSystem != null && $existingHomeAudioSystem != $aHomeAudioSystem)
    {
      $existingHomeAudioSystem->removeLocation($this);
    }
    $this->homeAudioSystem->addLocation($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    while (count($this->locationMusicItems) > 0)
    {
      $aLocationMusicItem = $this->locationMusicItems[count($this->locationMusicItems) - 1];
      $aLocationMusicItem->delete();
      unset($this->locationMusicItems[$this->indexOfLocationMusicItem($aLocationMusicItem)]);
      $this->locationMusicItems = array_values($this->locationMusicItems);
    }
    
      
    $placeholderHomeAudioSystem = $this->homeAudioSystem;
    $this->homeAudioSystem = null;
    $placeholderHomeAudioSystem->removeLocation($this);
  }

}
?>