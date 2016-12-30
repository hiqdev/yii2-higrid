hiqdev/yii2-higrid commits history
----------------------------------

## [0.1.1] - 2016-12-30

- Popover init can work without `grid` attribute
    - [aa2e8a5] 2016-12-30 csfixed [@silverfire]
    - [c1ae49d] 2016-12-16 Popover init can work without `grid` attribute [@tafid]
    - [9eddb9a] 2016-07-16 csfixed [@hiqsol]
- Added representations functionality to GridView
    - [df54902] 2016-06-10 csfixed [@hiqsol]
    - [08f06af] 2016-06-10 fixing build [@hiqsol]
    - [d854306] 2016-06-10 inited empty tests [@hiqsol]
    - [939e185] 2016-06-10 csfixed [@hiqsol]
    - [67f911d] 2016-06-10 added representations functionality to GridView [@hiqsol]
- Added `GridView::summaryRenderer` to change default summary rendering
    - [e36c73f] 2016-03-02 phpcsfixed [@hiqsol]
    - [6d688a6] 2016-03-02 rehideved [@hiqsol]
    - [d4b41ef] 2016-03-02 + `GridView::summaryRenderer` to change default summary rendering [@hiqsol]
- Added use of jQuery Resizable Columns plugin
    - [57ab5ed] 2015-11-27 DetailView - added missing use for InvalidConfigException [@silverfire]
    - [5ec2128] 2015-11-21 GridView - fixed JS initialization of resizable columns [@silverfire]
    - [0d95eed] 2015-11-09 JS for resizable columns is beibg registered in more abstract way [@silverfire]
    - [3be11ea] 2015-11-08 DataColumn now uses FeaturedColumnTrain [@silverfire]
    - [f476ddb] 2015-11-08 FeaturedColumnTrait - added support of jQuery resizable columns [@silverfire]
    - [f7cf885] 2015-11-08 GridView: added jQuery Resizable Columns plugin support, changed default ID generation algorythm [@silverfire]
    - [f3d47e0] 2015-11-06 Implemented resizable columns (need test) [@silverfire]
    - [6e75259] 2015-11-06 composer.json - Added bower-asset/jquery-resizable-columns [@silverfire]
- Removed use of Kartik GridView
    - [3998030] 2015-11-04 :exclamation: - removed Kartik GridView [@silverfire]
    - [bc60e14] 2015-10-08 fixed hidev config [@hiqsol]
- Added closure filter feature
    - [cd38136] 2015-10-08 moved Tofids closure filter feature to FeaturedColumnTrait [@hiqsol]
    - [13314e4] 2015-09-09 Rewrite filter render [@tafid]
- Added `boxed`, `sortAttribute` and `gridOptions` properties
    - [76a651e] 2015-09-07 FeaturedColumnTrait::getSortAttribute() - removed fallback to column atrrinute when `_sortAttribute` is false [@silverfire]
    - [9c046db] 2015-10-08 improved doc about 'gridOptions' [@hiqsol]
    - [29b5bf8] 2015-08-28 GridView::detailView - added ability to configure GridView object [@silverfire]
    - [c263171] 2015-08-26 php-cs-fixed [@hiqsol]
    - [50fdec7] 2015-08-26 rehideved [@hiqsol]
    - [135558e] 2015-08-26 + sortAttribute option [@hiqsol]
    - [811a9ba] 2015-07-30 Add new boxed property [@tafid]
- Added basics
    - [07043ac] 2015-07-24 php-cs-fixed [@hiqsol]
    - [06dd7d1] 2015-07-24 moved to src and rehideved [@hiqsol]
    - [09805e2] 2015-07-24 fixed GridView::detailView: + allModels [@hiqsol]
    - [9101c4b] 2015-07-24 fixed GridView::detailView() [@hiqsol]
    - [25519aa] 2015-05-24 hideved [@hiqsol]
    - [efb7f21] 2015-05-24 hideved [@hiqsol]
    - [0eb4c1c] 2015-04-21 DetailView - added passing of the primaryKey of the model to the renderDataCell [@silverfire]
    - [d4b6369] 2015-04-17 Update README.md [@hiqsol]
    - [2f652d0] 2015-04-10 + GridView [@hiqsol]
    - [37ae087] 2015-04-10 first working [@hiqsol]
    - [4c6f147] 2015-04-10 inited [@hiqsol]

## [Development started] - 2015-04-10

[@silverfire]: https://github.com/SilverFire
[d.naumenko.a@gmail.com]: https://github.com/SilverFire
[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@tafid]: https://github.com/tafid
[andreyklochok@gmail.com]: https://github.com/tafid
[df54902]: https://github.com/hiqdev/yii2-higrid/commit/df54902
[08f06af]: https://github.com/hiqdev/yii2-higrid/commit/08f06af
[d854306]: https://github.com/hiqdev/yii2-higrid/commit/d854306
[939e185]: https://github.com/hiqdev/yii2-higrid/commit/939e185
[67f911d]: https://github.com/hiqdev/yii2-higrid/commit/67f911d
[e36c73f]: https://github.com/hiqdev/yii2-higrid/commit/e36c73f
[6d688a6]: https://github.com/hiqdev/yii2-higrid/commit/6d688a6
[d4b41ef]: https://github.com/hiqdev/yii2-higrid/commit/d4b41ef
[57ab5ed]: https://github.com/hiqdev/yii2-higrid/commit/57ab5ed
[5ec2128]: https://github.com/hiqdev/yii2-higrid/commit/5ec2128
[0d95eed]: https://github.com/hiqdev/yii2-higrid/commit/0d95eed
[3be11ea]: https://github.com/hiqdev/yii2-higrid/commit/3be11ea
[f476ddb]: https://github.com/hiqdev/yii2-higrid/commit/f476ddb
[f7cf885]: https://github.com/hiqdev/yii2-higrid/commit/f7cf885
[f3d47e0]: https://github.com/hiqdev/yii2-higrid/commit/f3d47e0
[6e75259]: https://github.com/hiqdev/yii2-higrid/commit/6e75259
[3998030]: https://github.com/hiqdev/yii2-higrid/commit/3998030
[bc60e14]: https://github.com/hiqdev/yii2-higrid/commit/bc60e14
[cd38136]: https://github.com/hiqdev/yii2-higrid/commit/cd38136
[13314e4]: https://github.com/hiqdev/yii2-higrid/commit/13314e4
[76a651e]: https://github.com/hiqdev/yii2-higrid/commit/76a651e
[9c046db]: https://github.com/hiqdev/yii2-higrid/commit/9c046db
[29b5bf8]: https://github.com/hiqdev/yii2-higrid/commit/29b5bf8
[c263171]: https://github.com/hiqdev/yii2-higrid/commit/c263171
[50fdec7]: https://github.com/hiqdev/yii2-higrid/commit/50fdec7
[135558e]: https://github.com/hiqdev/yii2-higrid/commit/135558e
[811a9ba]: https://github.com/hiqdev/yii2-higrid/commit/811a9ba
[07043ac]: https://github.com/hiqdev/yii2-higrid/commit/07043ac
[06dd7d1]: https://github.com/hiqdev/yii2-higrid/commit/06dd7d1
[09805e2]: https://github.com/hiqdev/yii2-higrid/commit/09805e2
[9101c4b]: https://github.com/hiqdev/yii2-higrid/commit/9101c4b
[25519aa]: https://github.com/hiqdev/yii2-higrid/commit/25519aa
[efb7f21]: https://github.com/hiqdev/yii2-higrid/commit/efb7f21
[0eb4c1c]: https://github.com/hiqdev/yii2-higrid/commit/0eb4c1c
[d4b6369]: https://github.com/hiqdev/yii2-higrid/commit/d4b6369
[2f652d0]: https://github.com/hiqdev/yii2-higrid/commit/2f652d0
[37ae087]: https://github.com/hiqdev/yii2-higrid/commit/37ae087
[4c6f147]: https://github.com/hiqdev/yii2-higrid/commit/4c6f147
[aa2e8a5]: https://github.com/hiqdev/yii2-higrid/commit/aa2e8a5
[c1ae49d]: https://github.com/hiqdev/yii2-higrid/commit/c1ae49d
[9eddb9a]: https://github.com/hiqdev/yii2-higrid/commit/9eddb9a
[Under development]: https://github.com/hiqdev/yii2-higrid/releases/tag/Under development
[Under]: https://github.com/hiqdev/yii2-higrid/releases/tag/Under
[0.1.0]: https://github.com/hiqdev/yii2-higrid/releases/tag/0.1.0
[0.1.1]: https://github.com/hiqdev/yii2-higrid/releases/tag/0.1.1
