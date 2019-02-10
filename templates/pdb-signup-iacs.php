<?php
/*
 * Modification of the pdb-signup-default
 *
 */
 ?>
<div class="wrap <?php echo $this->wrap_class ?>" >

  <?php // output any validation errors
  $this->print_errors(); ?>
  <?php $this->print_form_head(); // this must be included before any fields are output. hidden fields may be added here as an array argument to the function ?>

    <table class="form-table pdb-signup">

      <?php while ( $this->have_groups() ) : $this->the_group(); ?>

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

        <?php while ( $this->have_fields() ) : $this->the_field(); ?>

        <tr class="<?php $this->field->print_element_class() ?>">

          <th for="<?php $this->field->print_element_id() ?>"><?php $this->field->print_label(); // this function adds the required marker ?>
            <?php if ( $this->field->has_help_text() ) :?>
            <span class="helptext"><?php $this->field->print_help_text() ?></span>
            <?php endif ?>
          </th>

          <td>

            <?php $this->field->print_element_with_id(); ?>

          </td>

        </tr>

        <?php endwhile; // fields ?>

        </tbody>

      <?php endwhile; // groups ?>

        <tbody class="field-group field-group-submit">

        <tr>
          <td class="submit-buttons">

           <?php $this->print_submit_button('button-primary'); // you can specify a class for the button ?>

          </td>
          <td class="submit-buttons">

           <?php $this->print_retrieve_link(); // this only prints if enabled in the settings ?>

          </td>
        </tr>

      </tbody>

    </table>

  <?php $this->print_form_close() ?>

</div>
