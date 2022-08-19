# phpBB 3.3 Extension - LMDI Trashbin

## Install

1. Download the latest release.
2. Unzip the downloaded release, and change the name of the folder to `trashbin`.
3. In the `ext` directory of your phpBB board, create a new directory named `lmdi` (if it does not already exist).
4. Copy the `trashbin` folder to `/ext/lmdi/`.
5. Navigate in the ACP to `Customise -> Manage extensions`.
6. Look for `LMDI Trashbin` under the Disabled Extensions list, and click its `Enable` link.

Enable the feature in the ACP (Extension tab).
The extension displays an item in the Quickmenu for moderators having the move permission.
You must select a target forum to enable the extension.

## Uninstall

1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `LMDI Trashbin` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/lmdi/trashbin` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)

## Note
This extension uses the (core) Prune forum feature for pruning topics put in the trashbin. This option is set in  the ACP.

