<?php
/**
 * Modification of the pdb-signup-default
 *
 */
?>
<div class="wrap <?php echo $this->wrap_class ?>">

  <?php
  /*
   * as of version 1.6 this template can handle the display when no record is found
   *
   *
   */
  if ( !empty( $this->participant_id ) ) :
    ?>

    <?php // output any validation errors
    $this->print_errors();
    ?>

    <?php
    // print the form header
    $this->print_form_head()
    ?>

    <?php while ( $this->have_groups() ) : $this->the_group(); ?>

      <table  class="form-table">

        <tbody class="field-group field-group-<?php echo $this->group->name ?>">
          <?php if ( $this->group->printing_title() ) : // are we printing group titles and descriptions? ?>
          <tr class="signup-group">
            <td colspan="2">

              <?php $this->group->print_title() ?>
              <?php $this->group->print_description() ?>

            </td>
          </tr>
          <?php else : ?>
          <?php endif; // end group title/description row ?>

          <?php
          // step through the fields in the current group

          while ( $this->have_fields() ) : $this->the_field();
            ?>

            <tr class="<?php $this->field->print_element_class() ?>">

              <th for="<?php $this->field->print_element_id() ?>"><?php $this->field->print_label() ?>
                <?php if ( $this->field->has_help_text() ) :?>
                <span class="helptext"><?php $this->field->print_help_text() ?></span>
                <?php endif ?>
              </th>
              <td>

                <?php $this->field->print_element_with_id(); ?>

              </td>

            </tr>

    <?php endwhile; // field loop  ?>

        </tbody>

      </table>

  <?php endwhile; // group loop  ?>
    <table class="form-table">

      <tbody class="field-group field-group-submit">

        <tr>
          <th><h3><?php $this->print_save_changes_label() ?></h3></th>
          <td class="submit-buttons">
  <?php $this->print_submit_button( 'button-primary' ); // you can specify a class for the button, second parameter sets button text  ?>
          </td>
        </tr>

      </tbody>

    </table><!-- end group -->

    <?php $this->print_form_close() ?>

  <?php else : ?>

    <?php $error_message = Participants_Db::plugin_setting( 'no_record_error_message', '' );

    if ( !empty( $error_message ) ) :
      ?>
      <p class="alert alert-error"><?php echo $error_message ?></p>

    <?php endif ?>

<?php endif ?>

</div>
