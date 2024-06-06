# zp-dcpi
DCPI-ASE WP Theme

## ACF Custom Post Types

### Training Event
Post Type Key: training-event

#### Fields
- region
- city
- event_venue
- start_date
  - Type: Date Picker
  - Display and Return Format: *F j, Y*
- end_date
- contact_person
- contact_mobile_number
- contact_email
- training_tracks
  - Type: Post Object
  - Post Type: event-tracks CPT
  - returns multiple post objects
  - A **Training Event** is made up of one or more **Event Tracks**
- attendance
  - Type: Number
  - The value here should be an automated total of the track_attendance fields of the multiple linked training_tracks
- manual_attendance
  - Type: Number
  - This is a transition tool where the trainer records the number of attendees manually. It should tally with the attendance field
 
### Training Track
Post Type Key: training-track

The organization's curriculum is presented in from of tracks; this would equate to units in a course. There are currently eight tracjs 

#### Fields
  - The Training Track CPT supports:
    - Title
    - Featured Image
    - Excerpt
    - Custom Fields
- abbreviation
  - Type: Text
- track_description
  -  Type: WYSIWYG Editor
-  track_banner
  - Type: Image
  - Return Format: Image Array
- track_banner_alt
  - Type: Image
  - Return Format: Image Array
- track_icon
  - Type: Image
  - Return Format: Image Array

#### Taxonomies
- Training Type

### Event Track
Post Type Key: event-track
- At each training event, registrants choose the tracks they wish to learn. These are the units of a training event.
- I have been thinking that we should make training-track hierarchical, and then we have event tracks as the children.
- Please note that my CPTs are designed in ACF
- This shuld appear within an event, not independently.
- The tracks being taught have been defined in the training-track CPT

#### Fields
- trainers
  - Type: user
  - Returns: Multiple User IDs
  - These are the trainers who conbsuct the training for each track
- parent_training_event
  - Type: Post Object
  - Returns: Post Object
  - This is the training-event
- training_track
  - Type: Post Object of type training-track
- leaders_trained
  - Type: Number
  - The total of all leaders_trained per track feeds the attendance field in the training-event
- registered_trainees
  - People fill up the registration form and the data is saved in the event-registration CPT. When the training is on, the trainees for this track are selected from the event-registration.
  - They register for the whole event then we pick which ones participated in which tracks here.
 
### Event Registrations
This is a global CPT with a field that records the training-event they are registering for.

#### Fields
- first_name
- last_name
- email
- mobile
- country
- region
- city
- contact_permission
- newsletter_subscription
- training_event_id
- attendance
- tracks_attended

My currrent pain point is how to set up multiple event-tracks within a training-event. This has to do with the model. 









