/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.22.0.5146 modeling language!*/

package ca.mcgill.ecse321.group01.homeaudiosystem.model;
import java.util.*;

// line 40 "../../../../../../../Umple/HomeAudioSystem.ump"
// line 82 "../../../../../../../Umple/HomeAudioSystem.ump"
public class Playlist implements LocationMusicItem
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Playlist Attributes
  private String title;

  //Playlist Associations
  private List<Song> songs;
  private HomeAudioSystem homeAudioSystem;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Playlist(String aTitle, HomeAudioSystem aHomeAudioSystem, Song... allSongs)
  {
    title = aTitle;
    songs = new ArrayList<Song>();
    boolean didAddSongs = setSongs(allSongs);
    boolean didAddHomeAudioSystem = setHomeAudioSystem(aHomeAudioSystem);
    if (!didAddHomeAudioSystem)
    {
      throw new RuntimeException("Unable to create playlist due to homeAudioSystem");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public boolean setTitle(String aTitle)
  {
    boolean wasSet = false;
    title = aTitle;
    wasSet = true;
    return wasSet;
  }

  public String getTitle()
  {
    return title;
  }

  public Song getSong(int index)
  {
    Song aSong = songs.get(index);
    return aSong;
  }

  public List<Song> getSongs()
  {
    List<Song> newSongs = Collections.unmodifiableList(songs);
    return newSongs;
  }

  public int numberOfSongs()
  {
    int number = songs.size();
    return number;
  }

  public boolean hasSongs()
  {
    boolean has = songs.size() > 0;
    return has;
  }

  public int indexOfSong(Song aSong)
  {
    int index = songs.indexOf(aSong);
    return index;
  }

  public HomeAudioSystem getHomeAudioSystem()
  {
    return homeAudioSystem;
  }

  public static int minimumNumberOfSongs()
  {
    return 1;
  }

  public boolean addSong(Song aSong)
  {
    boolean wasAdded = false;
    if (songs.contains(aSong)) { return false; }
    if (songs.contains(aSong)) { return false; }
    songs.add(aSong);
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeSong(Song aSong)
  {
    boolean wasRemoved = false;
    if (!songs.contains(aSong))
    {
      return wasRemoved;
    }

    if (numberOfSongs() <= minimumNumberOfSongs())
    {
      return wasRemoved;
    }

    songs.remove(aSong);
    wasRemoved = true;
    return wasRemoved;
  }

  public boolean setSongs(Song... newSongs)
  {
    boolean wasSet = false;
    ArrayList<Song> verifiedSongs = new ArrayList<Song>();
    for (Song aSong : newSongs)
    {
      if (verifiedSongs.contains(aSong))
      {
        continue;
      }
      verifiedSongs.add(aSong);
    }

    if (verifiedSongs.size() != newSongs.length || verifiedSongs.size() < minimumNumberOfSongs())
    {
      return wasSet;
    }

    songs.clear();
    songs.addAll(verifiedSongs);
    wasSet = true;
    return wasSet;
  }

  public boolean addSongAt(Song aSong, int index)
  {  
    boolean wasAdded = false;
    if(addSong(aSong))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSongs()) { index = numberOfSongs() - 1; }
      songs.remove(aSong);
      songs.add(index, aSong);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveSongAt(Song aSong, int index)
  {
    boolean wasAdded = false;
    if(songs.contains(aSong))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSongs()) { index = numberOfSongs() - 1; }
      songs.remove(aSong);
      songs.add(index, aSong);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addSongAt(aSong, index);
    }
    return wasAdded;
  }

  public boolean setHomeAudioSystem(HomeAudioSystem aHomeAudioSystem)
  {
    boolean wasSet = false;
    if (aHomeAudioSystem == null)
    {
      return wasSet;
    }

    HomeAudioSystem existingHomeAudioSystem = homeAudioSystem;
    homeAudioSystem = aHomeAudioSystem;
    if (existingHomeAudioSystem != null && !existingHomeAudioSystem.equals(aHomeAudioSystem))
    {
      existingHomeAudioSystem.removePlaylist(this);
    }
    homeAudioSystem.addPlaylist(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    songs.clear();
    HomeAudioSystem placeholderHomeAudioSystem = homeAudioSystem;
    this.homeAudioSystem = null;
    placeholderHomeAudioSystem.removePlaylist(this);
  }

  @Override
  public void play(){
          return ;
  }


  public String toString()
  {
	  String outputString = "";
    return super.toString() + "["+
            "title" + ":" + getTitle()+ "]" + System.getProperties().getProperty("line.separator") +
            "  " + "homeAudioSystem = "+(getHomeAudioSystem()!=null?Integer.toHexString(System.identityHashCode(getHomeAudioSystem())):"null")
     + outputString;
  }
}