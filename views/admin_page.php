<h1><?php _e('Opauth', 'wp-opauth'); ?></h1>

<form id="opauth-config" method="post">
	<h2><?php _e('General Options', 'wp-opauth'); ?></h2>
	<input type="checkbox" name="areButtonsOutside"
		<?php if ($areButtonsOutside) echo 'checked="yes"'; ?> >
	<?php
		_e('Try placing the login buttons below the login form', 'wp-opauth');
		ksort($strategies);
		foreach ($strategies as $id => $info)
		{
			$hid = htmlspecialchars($id);
			echo '<div class="opauth-strategy-config">';
			echo "<h2>$hid</h2>";
			echo '<input ';
			if (array_key_exists($id, $values))
			{
				echo 'checked="yes" ';
			}
			echo "type=\"checkbox\" name=\"{$hid}[enabled]\"> ";
			_e('Enabled', 'wp-opauth');
			echo '<br>';
			foreach ($info as $name => $v)
			{
				$name = htmlspecialchars($name);
				/* Only null values are to be edited via the panel */
				if ($v === null)
				{
					echo "$name: ";
					echo '<input ';
					if (array_key_exists($id, $values)
							&& array_key_exists($name, $values[$id]))
					{
						echo 'value="' . htmlspecialchars($values[$id][$name]) . '" ';
					}
					echo "type=\"text\" name=\"{$hid}[$name]\">";
					echo '<br>';
				}
			}
			if (array_key_exists($id, $callbackURLs))
			{
				echo "<span>";
				_e('Return URL', 'wp-opauth');
				echo ': ', $callbackURLs[$id], '</span>';
			}
			echo '</div>';
		}
	?>
	<input type="submit" value="<?php _e('Store Settings', 'wp-opauth'); ?>">
</form>