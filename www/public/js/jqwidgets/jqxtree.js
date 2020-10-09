/*
jQWidgets v10.1.5 (2020-Sep)
Copyright (c) 2011-2020 jQWidgets.
License: https://jqwidgets.com/license/
*/
/* eslint-disable */

(function (a) {
    a.jqx.jqxWidget("jqxTree", "", {});
    a.extend(a.jqx._jqxTree.prototype, {
        defineInstance: function () {
            var b = {
                items: new Array(),
                width: null,
                height: null,
                easing: "easeInOutCirc",
                animationShowDuration: "fast",
                animationHideDuration: "fast",
                treeElements: new Array(),
                disabled: false,
                itemsMember: "",
                displayMember: "",
                valueMember: "",
                enableHover: true,
                keyboardNavigation: true,
                enableKeyboardNavigation: true,
                toggleMode: "dblclick",
                source: null,
                checkboxes: false,
                checkSize: 16,
                toggleIndicatorSize: 18,
                hasThreeStates: false,
                selectedItem: null,
                touchMode: "auto",
                allowDrag: true,
                allowDrop: true,
                searchMode: "startswithignorecase",
                incrementalSearch: true,
                incrementalSearchDelay: 700,
                animationHideDelay: 0,
                submitCheckedItems: false,
                dragStart: null,
                dragEnd: null,
                rtl: false,
                dropAction: "default",
                events: [
                    "expand",
                    "collapse",
                    "select",
                    "initialized",
                    "added",
                    "removed",
                    "checkChange",
                    "dragEnd",
                    "dragStart",
                    "itemClick",
                ],
                aria: {
                    "aria-activedescendant": {
                        name: "getActiveDescendant",
                        type: "string",
                    },
                    "aria-disabled": { name: "disabled", type: "boolean" },
                },
            };
            if (this === a.jqx._jqxTree.prototype) {
                return b;
            }
            a.extend(true, this, b);
            return b;
        },
        createInstance: function (c) {
            var b = this;
            this.host.attr("role", "tree");
            this.host.attr("data-role", "treeview");
            this.enableKeyboardNavigation = this.keyboardNavigation;
            this.propertyChangeMap.disabled = function (f, h, g, i) {
                if (b.disabled) {
                    b.host.addClass(b.toThemeProperty("jqx-tree-disabled"));
                } else {
                    b.host.removeClass(b.toThemeProperty("jqx-tree-disabled"));
                }
                a.jqx.aria(b, "aria-disabled", i);
            };
            if (
                this.width != null &&
                this.width.toString().indexOf("px") != -1
            ) {
                this.host.width(this.width);
            } else {
                if (this.width != undefined && !isNaN(this.width)) {
                    this.host.width(this.width);
                }
            }
            if (
                this.height != null &&
                this.height.toString().indexOf("px") != -1
            ) {
                this.host.height(this.height);
            } else {
                if (this.height != undefined && !isNaN(this.height)) {
                    this.host.height(this.height);
                }
            }
            if (
                this.width != null &&
                this.width.toString().indexOf("%") != -1
            ) {
                this.host.width(this.width);
            }
            if (
                this.height != null &&
                this.height.toString().indexOf("%") != -1
            ) {
                this.host.height(this.height);
            }
            if (!this.host.attr("tabindex")) {
                this.host.attr("tabIndex", 1);
            }
            if (this.disabled) {
                this.host.addClass(this.toThemeProperty("jqx-tree-disabled"));
                a.jqx.aria(this, "aria-disabled", true);
            }
            if (this.host.jqxDragDrop) {
                window.jqxTreeDragDrop();
            }
            this.originalInnerHTML = this.element.innerHTML;
            this.createdTree = false;
            if (this.element.innerHTML.indexOf("UL")) {
                var e = this.host.find("ul:first");
                if (e.length > 0) {
                    this.createTree(e[0]);
                    this.createdTree = true;
                }
            }
            if (this.source != null) {
                var d = this.loadItems(this.source);
                this.element.innerHTML = d;
                var e = this.host.find("ul:first");
                if (e.length > 0) {
                    this.createTree(e[0]);
                    this.createdTree = true;
                }
            }
            this._itemslength = this.items.length;
            if (!this.createdTree) {
                if (this.host.find("ul").length == 0) {
                    this.host.append(a("<ul></ul>"));
                    var e = this.host.find("ul:first");
                    if (e.length > 0) {
                        this.createTree(e[0]);
                        this.createdTree = true;
                    }
                    this.createdTree = true;
                }
            }
            if (this.createdTree == true) {
                this._render();
                this._handleKeys();
            }
            this._updateCheckLayout();
        },
        checkItems: function (f, h) {
            var e = this;
            if (f != null) {
                var d = 0;
                var g = false;
                var b = 0;
                var i = a(f.element).find("li");
                b = i.length;
                a.each(i, function (j) {
                    var k = e.itemMapping["id" + this.id].item;
                    if (k.checked != false) {
                        if (k.checked == null) {
                            g = true;
                        }
                        d++;
                    }
                });
                if (f != h) {
                    if (d == b) {
                        this.checkItem(f.element, true, "tree");
                    } else {
                        if (d > 0) {
                            this.checkItem(f.element, null, "tree");
                        } else {
                            this.checkItem(f.element, false, "tree");
                        }
                    }
                } else {
                    var c = h.checked;
                    var i = a(h.element).find("li");
                    a.each(i, function () {
                        var j = e.itemMapping["id" + this.id].item;
                        e.checkItem(this, c, "tree");
                    });
                }
                this.checkItems(this._parentItem(f), h);
            } else {
                var c = h.checked;
                var i = a(h.element).find("li");
                a.each(i, function () {
                    var j = e.itemMapping["id" + this.id].item;
                    e.checkItem(this, c, "tree");
                });
            }
        },
        _getMatches: function (e, f) {
            if (e == undefined || e.length == 0) {
                return -1;
            }
            var c = this.items;
            var b = new Array();
            for (var d = 0; d < c.length; d++) {
                if (this._isVisible(c[d]) && !c[d].disabled) {
                    b.push(c[d]);
                }
            }
            c = b;
            if (f != undefined) {
                c = c.slice(f);
            }
            var g = new Array();
            a.each(c, function (j) {
                var k = this.label;
                if (!k) {
                    k = "";
                }
                var h = a.jqx.string.startsWithIgnoreCase(k.toString(), e);
                if (h) {
                    g.push({ id: this.id, element: this.element });
                }
            });
            return g;
        },
        _handleKeys: function () {
            var b = this;
            this.addHandler(this.host, "keydown", function (d) {
                var s = d.keyCode;
                if (b.keyboardNavigation || b.enableKeyboardNavigation) {
                    if (b.selectedItem != null) {
                        var l = b.selectedItem.element;
                        if (b.incrementalSearch && !(s >= 33 && s <= 40)) {
                            var t = -1;
                            if (!b._searchString) {
                                b._searchString = "";
                            }
                            if (
                                (s == 8 || s == 46) &&
                                b._searchString.length >= 1
                            ) {
                                b._searchString = b._searchString.substr(
                                    0,
                                    b._searchString.length - 1
                                );
                            }
                            var h = String.fromCharCode(s);
                            var o = !isNaN(parseInt(h));
                            var n = false;
                            if (
                                (s >= 65 && s <= 97) ||
                                o ||
                                s == 8 ||
                                s == 32 ||
                                s == 46
                            ) {
                                if (!d.shiftKey) {
                                    h = h.toLocaleLowerCase();
                                }
                                if (s != 8 && s != 32 && s != 46) {
                                    if (
                                        !(
                                            b._searchString.length > 0 &&
                                            b._searchString.substr(0, 1) == h
                                        )
                                    ) {
                                        b._searchString += h;
                                    }
                                }
                                if (s == 32) {
                                    b._searchString += " ";
                                }
                                b._searchTime = new Date();
                                var r = b.selectedItem;
                                if (r) {
                                    var g = r.id;
                                    var m = -1;
                                    for (var k = 0; k < b.items.length; k++) {
                                        if (b.items[k].id == g) {
                                            m = k + 1;
                                            break;
                                        }
                                    }
                                    var f = b._getMatches(b._searchString, m);
                                    if (
                                        f.length == 0 ||
                                        (f.length > 0 && f[0].id == g)
                                    ) {
                                        var f = b._getMatches(b._searchString);
                                    }
                                } else {
                                    var f = b._getMatches(b._searchString);
                                }
                                if (f.length > 0) {
                                    var r = b.selectedItem;
                                    if (
                                        b.selectedItem &&
                                        b.selectedItem.id != f[0].id
                                    ) {
                                        b.clearSelection();
                                        b.selectItem(f[0].element, "keyboard");
                                    }
                                    b._lastSearchString = b._searchString;
                                }
                            }
                            if (b._searchTimer != undefined) {
                                clearTimeout(b._searchTimer);
                            }
                            if (s == 27 || s == 13) {
                                b._searchString = "";
                                b._lastSearchString = "";
                            }
                            b._searchTimer = setTimeout(function () {
                                b._searchString = "";
                                b._lastSearchString = "";
                            }, 500);
                            if (t >= 0) {
                                return;
                            }
                            if (n) {
                                return false;
                            }
                        }
                        switch (s) {
                            case 32:
                                if (b.checkboxes) {
                                    b.fromKey = true;
                                    var q = a(
                                        b.selectedItem.checkBoxElement
                                    ).jqxCheckBox("checked");
                                    b.checkItem(
                                        b.selectedItem.element,
                                        !q,
                                        "tree"
                                    );
                                    if (b.hasThreeStates) {
                                        b.checkItems(
                                            b.selectedItem,
                                            b.selectedItem
                                        );
                                    }
                                    return false;
                                }
                                return true;
                            case 33:
                                var j = b._getItemsOnPage();
                                var p = b.selectedItem;
                                for (var k = 0; k < j; k++) {
                                    p = b._prevVisibleItem(p);
                                }
                                if (p != null) {
                                    b.selectItem(p.element, "keyboard");
                                    b.ensureVisible(p.element);
                                } else {
                                    b.selectItem(
                                        b._firstItem().element,
                                        "keyboard"
                                    );
                                    b.ensureVisible(b._firstItem().element);
                                }
                                return false;
                            case 34:
                                var j = b._getItemsOnPage();
                                var c = b.selectedItem;
                                for (var k = 0; k < j; k++) {
                                    c = b._nextVisibleItem(c);
                                }
                                if (c != null) {
                                    b.selectItem(c.element, "keyboard");
                                    b.ensureVisible(c.element);
                                } else {
                                    b.selectItem(
                                        b._lastItem().element,
                                        "keyboard"
                                    );
                                    b.ensureVisible(b._lastItem().element);
                                }
                                return false;
                            case 37:
                            case 39:
                                if ((s == 37 && !b.rtl) || (s == 39 && b.rtl)) {
                                    if (
                                        b.selectedItem.hasItems &&
                                        b.selectedItem.isExpanded
                                    ) {
                                        b.collapseItem(l);
                                    } else {
                                        var e = b._parentItem(b.selectedItem);
                                        if (e != null) {
                                            b.selectItem(e.element, "keyboard");
                                            b.ensureVisible(e.element);
                                        }
                                    }
                                }
                                if ((s == 39 && !b.rtl) || (s == 37 && b.rtl)) {
                                    if (b.selectedItem.hasItems) {
                                        if (!b.selectedItem.isExpanded) {
                                            b.expandItem(l);
                                        } else {
                                            var c = b._nextVisibleItem(
                                                b.selectedItem
                                            );
                                            if (c != null) {
                                                b.selectItem(
                                                    c.element,
                                                    "keyboard"
                                                );
                                                b.ensureVisible(c.element);
                                            }
                                        }
                                    }
                                }
                                return false;
                            case 13:
                                if (b.selectedItem.hasItems) {
                                    if (b.selectedItem.isExpanded) {
                                        b.collapseItem(l);
                                    } else {
                                        b.expandItem(l);
                                    }
                                }
                                return false;
                            case 36:
                                b.selectItem(
                                    b._firstItem().element,
                                    "keyboard"
                                );
                                b.ensureVisible(b._firstItem().element);
                                return false;
                            case 35:
                                b.selectItem(b._lastItem().element, "keyboard");
                                b.ensureVisible(b._lastItem().element);
                                return false;
                            case 38:
                                var p = b._prevVisibleItem(b.selectedItem);
                                if (p != null) {
                                    b.selectItem(p.element, "keyboard");
                                    b.ensureVisible(p.element);
                                }
                                return false;
                            case 40:
                                var c = b._nextVisibleItem(b.selectedItem);
                                if (c != null) {
                                    b.selectItem(c.element, "keyboard");
                                    b.ensureVisible(c.element);
                                }
                                return false;
                        }
                    }
                }
            });
        },
        _firstItem: function () {
            var e = null;
            var d = this;
            var g = this.host.find("ul:first");
            var f = a(g).find("li");
            for (var c = 0; c <= f.length - 1; c++) {
                var b = f[c];
                e = this.itemMapping["id" + b.id].item;
                if (d._isVisible(e)) {
                    return e;
                }
            }
            return null;
        },
        _lastItem: function () {
            var e = null;
            var d = this;
            var g = this.host.find("ul:first");
            var f = a(g).find("li");
            for (var c = f.length - 1; c >= 0; c--) {
                var b = f[c];
                e = this.itemMapping["id" + b.id].item;
                if (d._isVisible(e)) {
                    return e;
                }
            }
            return null;
        },
        _parentItem: function (d) {
            if (d == null || d == undefined) {
                return null;
            }
            var c = d.parentElement;
            if (!c) {
                return null;
            }
            var b = null;
            a.each(this.items, function () {
                if (this.element == c) {
                    b = this;
                    return false;
                }
            });
            return b;
        },
        _nextVisibleItem: function (c) {
            if (c == null || c == undefined) {
                return null;
            }
            var b = c;
            while (b != null) {
                b = b.nextItem;
                if (this._isVisible(b) && !b.disabled) {
                    return b;
                }
            }
            return null;
        },
        _prevVisibleItem: function (c) {
            if (c == null || c == undefined) {
                return null;
            }
            var b = c;
            while (b != null) {
                b = b.prevItem;
                if (this._isVisible(b) && !b.disabled) {
                    return b;
                }
            }
            return null;
        },
        _isVisible: function (c) {
            if (c == null || c == undefined) {
                return false;
            }
            if (!this._isElementVisible(c.element)) {
                return false;
            }
            var b = this._parentItem(c);
            if (b == null) {
                return true;
            }
            if (b != null) {
                if (!this._isElementVisible(b.element)) {
                    return false;
                }
                if (b.isExpanded) {
                    while (b != null) {
                        b = this._parentItem(b);
                        if (b != null && !this._isElementVisible(b.element)) {
                            return false;
                        }
                        if (b != null && !b.isExpanded) {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }
            return true;
        },
        _getItemsOnPage: function () {
            var d = 0;
            var c = this.panel.jqxPanel("getVScrollPosition");
            var b = parseInt(this.host.height());
            var f = 0;
            var e = this._firstItem();
            if (parseInt(a(e.element).height()) > 0) {
                while (f <= b) {
                    f += parseInt(a(e.element).outerHeight());
                    d++;
                }
            }
            return d;
        },
        _isElementVisible: function (b) {
            if (b == null) {
                return false;
            }
            if (
                a(b).css("display") != "none" &&
                a(b).css("visibility") != "hidden"
            ) {
                return true;
            }
            return false;
        },
        refresh: function (c) {
            if (
                this.width != null &&
                this.width.toString().indexOf("px") != -1
            ) {
                this.host.width(this.width);
            } else {
                if (this.width != undefined && !isNaN(this.width)) {
                    this.host.width(this.width);
                }
            }
            if (
                this.height != null &&
                this.height.toString().indexOf("px") != -1
            ) {
                this.host.height(this.height);
            } else {
                if (this.height != undefined && !isNaN(this.height)) {
                    this.host.height(this.height);
                }
            }
            if (this.panel) {
                if (
                    this.width != null &&
                    this.width.toString().indexOf("%") != -1
                ) {
                    var b = this;
                    this.panel.jqxPanel("width", "100%");
                    b.removeHandler(a(window), "resize.jqxtree" + b.element.id);
                    b.addHandler(
                        a(window),
                        "resize.jqxtree" + b.element.id,
                        function () {
                            b._calculateWidth();
                        }
                    );
                } else {
                    this.panel.jqxPanel("width", this.host.width());
                }
                this.panel.jqxPanel("_arrange");
            }
            this._calculateWidth();
            if (a.jqx.isHidden(this.host)) {
                var b = this;
                if (this._hiddenTimer) {
                    clearInterval(this._hiddenTimer);
                }
                this._hiddenTimer = setInterval(function () {
                    if (!a.jqx.isHidden(b.host)) {
                        clearInterval(b._hiddenTimer);
                        b._calculateWidth();
                    }
                }, 100);
            }
            if (c != true) {
                if (this.checkboxes) {
                    this._updateCheckLayout(null);
                }
            }
        },
        resize: function (c, b) {
            this.width = c;
            this.height = b;
            this.refresh();
        },
        loadItems: function (c) {
            if (c == null) {
                return;
            }
            var b = this;
            this.items = new Array();
            var d = "<ul>";
            a.map(c, function (e) {
                if (e == undefined) {
                    return null;
                }
                d += b._parseItem(e);
            });
            d += "</ul>";
            return d;
        },
        _parseItem: function (m) {
            var g = "";
            if (m == undefined) {
                return null;
            }
            var j = m.label;
            var l = m.value;
            if (!m.label && m.html) {
                j = m.html;
            }
            if (this.displayMember != undefined && this.displayMember != "") {
                j = m[this.displayMember];
            }
            if (this.valueMember != undefined && this.valueMember != "") {
                l = m[this.valueMember];
            }
            if (!j) {
                j = "Item";
            }
            if (typeof m === "string") {
                j = m;
            }
            var h = false;
            if (m.expanded != undefined && m.expanded) {
                h = true;
            }
            var f = false;
            if (m.locked != undefined && m.locked) {
                f = true;
            }
            var d = false;
            if (m.selected != undefined && m.selected) {
                d = true;
            }
            var e = false;
            if (m.disabled != undefined && m.disabled) {
                e = true;
            }
            var k = false;
            if (m.checked != undefined && m.checked) {
                k = true;
            }
            var i = m.icon;
            var c = m.iconsize;
            g += "<li";
            if (h) {
                g += ' item-expanded="true" ';
            }
            if (f) {
                g += ' item-locked="true" ';
            }
            if (e) {
                g += ' item-disabled="true" ';
            }
            if (d) {
                g += ' item-selected="true" ';
            }
            if (c) {
                g += ' item-iconsize="' + m.iconsize + '" ';
            }
            if (i != null && i != undefined) {
                g += ' item-icon="' + i + '" ';
            }
            if (m.label && !m.html) {
                g += ' item-label="' + j + '" ';
            }
            if (l != null) {
                g += ' item-value="' + l + '" ';
            }
            if (m.checked != undefined) {
                g += ' item-checked="' + k + '" ';
            }
            var b = "";
            if (m.id != undefined) {
                b = m.id;
                g += ' id="' + b + '" ';
            } else {
                b = this.createID();
                g += ' id="' + b + '" ';
            }
            g += ">" + j;
            if (m.items) {
                g += this.loadItems(m.items);
            } else {
                if (this.itemsMember != undefined && this.itemsMember != "") {
                    if (m[this.itemsMember]) {
                        g += this.loadItems(m[this.itemsMember]);
                    }
                }
            }
            if (!this._valueList) {
                this._valueList = new Array();
            }
            this._valueList[b] = m.value;
            g += "</li>";
            return g;
        },
        ensureVisible: function (f) {
            if (f == null || f == undefined) {
                return;
            }
            if (this.panel) {
                var c = this.panel.jqxPanel("getVScrollPosition");
                var g = this.panel.jqxPanel("getHScrollPosition");
                var b = parseInt(this.host.height());
                var e = a(f).find(".jqx-tree-item:first");
                var h = a(e).position().top;
                if (c === 0 && h === 0) {
                    return;
                }
                var d = this.panel.jqxPanel("hScrollBar").outerHeight();
                if (h <= c || h >= b + c) {
                    this.panel.jqxPanel(
                        "scrollTo",
                        g,
                        h - b + a(e).outerHeight() + d
                    );
                }
            }
        },
        _syncItems: function (c) {
            this._visibleItems = new Array();
            var b = this;
            a.each(c, function () {
                var e = a(this);
                if (e.css("display") != "none") {
                    var d = e.outerHeight();
                    if (e.height() > 0) {
                        var f = parseInt(e.offset().top);
                        b._visibleItems[b._visibleItems.length] = {
                            element: this,
                            top: f,
                            height: d,
                            bottom: f + d,
                        };
                    }
                }
            });
        },
        hitTest: function (h, g) {
            var d = this;
            var b = this;
            var f = null;
            var e = this.host.find(".jqx-item");
            this._syncItems(e);
            if (b._visibleItems) {
                var c = parseInt(b.host.offset().left);
                var i = b.host.outerWidth();
                a.each(b._visibleItems, function (k) {
                    if (h >= c && h < c + i) {
                        if (this.top + 5 < g && g < this.top + this.height) {
                            var j = a(this.element).parents("li:first");
                            if (j.length > 0) {
                                f = b.getItem(j[0]);
                                if (f != null) {
                                    f.height = this.height;
                                    f.top = this.top;
                                    return false;
                                }
                            }
                        }
                    }
                });
            }
            return f;
        },
        addBefore: function (b, d, c) {
            return this.addBeforeAfter(b, d, true, c);
        },
        addAfter: function (b, d, c) {
            return this.addBeforeAfter(b, d, false, c);
        },
        addBeforeAfter: function (n, q, p, m) {
            var k = this;
            var l = new Array();
            if (q && q.treeInstance != undefined) {
                q = q.element;
            }
            if (!a.isArray(n)) {
                l[0] = n;
            } else {
                l = n;
            }
            var g = "";
            var o = this;
            a.each(l, function () {
                g += o._parseItem(this);
            });
            var b = a(g);
            if (k.element.innerHTML.indexOf("UL")) {
                var h = k.host.find("ul:first");
            }
            if (q == undefined && q == null) {
                h.append(b);
            } else {
                if (p) {
                    a(q).before(b);
                } else {
                    a(q).after(b);
                }
            }
            var d = b;
            for (var i = 0; i < d.length; i++) {
                this._createItem(d[i]);
                var c = a(d[i]).find("li");
                if (c.length > 0) {
                    for (var f = 0; f < c.length; f++) {
                        this._createItem(c[f]);
                    }
                }
            }
            var e = function (j) {
                o._refreshMapping(false);
                o._updateItemsNavigation();
                if (j && o.allowDrag && o._enableDragDrop) {
                    o._enableDragDrop();
                }
                if (o.selectedItem != null) {
                    a(o.selectedItem.titleElement).addClass(
                        o.toThemeProperty("jqx-fill-state-pressed")
                    );
                    a(o.selectedItem.titleElement).addClass(
                        o.toThemeProperty("jqx-tree-item-selected")
                    );
                }
            };
            if (m == false) {
                e(true);
                this._raiseEvent("4", { items: this.getItems() });
                return;
            }
            e(false);
            o._render();
            this._raiseEvent("4", { items: this.getItems() });
            if (o.checkboxes) {
                o._updateCheckLayout(null);
            }
        },
        addTo: function (n, g, f) {
            var b = this;
            var i = new Array();
            if (g && g.treeInstance != undefined) {
                g = g.element;
            }
            if (!a.isArray(n)) {
                i[0] = n;
            } else {
                i = n;
            }
            var m = "";
            var t = this;
            a.each(i, function () {
                m += t._parseItem(this);
            });
            var c = a(m);
            if (b.element.innerHTML.indexOf("UL")) {
                var q = b.host.find("ul:first");
            }
            if (g == undefined && g == null) {
                q.append(c);
            } else {
                g = a(g);
                var k = g.find("ul:first");
                if (k.length == 0) {
                    var s = a("<ul></ul>");
                    a(g).append(s);
                    k = g.find("ul:first");
                    var r = b.itemMapping["id" + g[0].id].item;
                    r.subtreeElement = k[0];
                    r.hasItems = true;
                    k.addClass(b.toThemeProperty("jqx-tree-dropdown"));
                    if (t.rtl) {
                        k.addClass(b.toThemeProperty("jqx-tree-dropdown-rtl"));
                    }
                    k.append(c);
                    var d = k.find("li:first");
                    r.parentElement = d;
                } else {
                    k.append(c);
                }
            }
            var p = c;
            for (var h = 0; h < p.length; h++) {
                this._createItem(p[h]);
                var e = a(p[h]).find("li");
                if (e.length > 0) {
                    for (var o = 0; o < e.length; o++) {
                        this._createItem(e[o]);
                    }
                }
            }
            var l = function (j) {
                t._refreshMapping(false);
                t._updateItemsNavigation();
                if (j && t.allowDrag && t._enableDragDrop) {
                    t._enableDragDrop();
                }
                if (t.selectedItem != null) {
                    a(t.selectedItem.titleElement).addClass(
                        t.toThemeProperty("jqx-fill-state-pressed")
                    );
                    a(t.selectedItem.titleElement).addClass(
                        t.toThemeProperty("jqx-tree-item-selected")
                    );
                }
            };
            if (f == false) {
                l(true);
                this._raiseEvent("4", { items: this.getItems() });
                return;
            }
            l(false);
            t._render();
            if (t.checkboxes) {
                t._updateCheckLayout(null);
            }
            this._raiseEvent("4", { items: this.getItems() });
        },
        updateItem: function (e, i) {
            var h = e.treeInstance != undefined ? e : this.getItem(e);
            if (!h) {
                var d = e;
                e = i;
                i = d;
                var h = e.treeInstance != undefined ? e : this.getItem(e);
            }
            if (h) {
                if (typeof i === "string") {
                    i = { label: i };
                }
                if (i.value) {
                    h.value = i.value;
                }
                if (i.label) {
                    h.label = i.label;
                    a.jqx.utilities.html(a(h.titleElement), i.label);
                    var b = a.jqx.browser.msie && a.jqx.browser.version < 8;
                    if (b) {
                        a(document.body).append(this._measureItem);
                        this._measureItem.html(a(h.titleElement).text());
                        var g = this._measureItem.width();
                        if (h.icon) {
                            g += 20;
                        }
                        if (a(a(h.titleElement).find("img")).length > 0) {
                            g += 20;
                        }
                        a(h.titleElement).css("max-width", g + "px");
                        this._measureItem.remove();
                    }
                }
                if (i.icon) {
                    if (a(h.element).children(".itemicon").length > 0) {
                        a(h.element).find(".itemicon")[0].src = i.icon;
                    } else {
                        var c = i.iconsize;
                        if (!c) {
                            c = 16;
                        }
                        var f = a(
                            '<img width="' +
                                c +
                                '" height="' +
                                c +
                                '" style="float: left;" class="itemicon" src="' +
                                i.icon +
                                '"/>'
                        );
                        a(h.titleElement).prepend(f);
                        f.css("margin-right", "6px");
                        if (this.rtl) {
                            f.css("margin-right", "0px");
                            f.css("margin-left", "6px");
                            f.css("float", "right");
                        }
                    }
                }
                if (i.expanded) {
                    this.expandItem(h);
                }
                if (i.disabled) {
                    this.disableItem(h);
                }
                if (i.selected) {
                    this.selectItem(h);
                }
                return true;
            }
            return false;
        },
        removeItem: function (b, d) {
            if (b == undefined || b == null) {
                return;
            }
            if (b.treeInstance != undefined) {
                b = b.element;
            }
            var e = this;
            var h = b.id;
            var c = -1;
            var f = this.getItem(b);
            if (f) {
                c = this.items.indexOf(f);
                if (c != -1) {
                    (function g(p) {
                        var n = -1;
                        n = this.items.indexOf(p);
                        if (n != -1) {
                            this.items.splice(n, 1);
                        }
                        var k = a(p.element).find("li");
                        var j = k.length;
                        var o = this;
                        var l = new Array();
                        if (j > 0) {
                            a.each(k, function (i) {
                                var q = o.itemMapping["id" + this.id].item;
                                l.push(q);
                            });
                            for (var m = 0; m < l.length; m++) {
                                g.apply(this, [l[m]]);
                            }
                        }
                    }.apply(this, [f]));
                }
            }
            if (this.host.find("#" + b.id).length > 0) {
                a(b).remove();
            }
            if (d == false) {
                this._raiseEvent("5");
                return;
            }
            e._updateItemsNavigation();
            if (e.allowDrag && e._enableDragDrop) {
                e._render(true, false);
            } else {
                e._render();
            }
            if (e.selectedItem != null) {
                if (e.selectedItem.element == b) {
                    a(e.selectedItem.titleElement).removeClass(
                        e.toThemeProperty("jqx-fill-state-pressed")
                    );
                    a(e.selectedItem.titleElement).removeClass(
                        e.toThemeProperty("jqx-tree-item-selected")
                    );
                    e.selectedItem = null;
                }
            }
            this._raiseEvent("5");
            if (e.checkboxes) {
                e._updateCheckLayout(null);
            }
        },
        clear: function () {
            this.items = new Array();
            this.itemMapping = new Array();
            var b = this.host.find("ul:first");
            if (b.length > 0) {
                b[0].innerHTML = "";
            }
            this.selectedItem = null;
        },
        disableItem: function (b) {
            if (b == null) {
                return false;
            }
            if (b.treeInstance != undefined) {
                b = b.element;
            }
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (d.element == b) {
                    d.disabled = true;
                    a(d.titleElement).addClass(
                        c.toThemeProperty("jqx-fill-state-disabled")
                    );
                    a(d.titleElement).addClass(
                        c.toThemeProperty("jqx-tree-item-disabled")
                    );
                    if (c.checkboxes && d.checkBoxElement) {
                        a(d.checkBoxElement).jqxCheckBox({ disabled: true });
                    }
                    return false;
                }
            });
        },
        _updateInputSelection: function () {
            if (this.input) {
                if (this.selectedItem == null) {
                    this.input.val("");
                } else {
                    var c = this.selectItem.value;
                    if (c == null) {
                        c = this.selectedItem.label;
                    }
                    this.input.val(c);
                }
                if (this.checkboxes) {
                    var b = this.getCheckedItems();
                    if (this.submitCheckedItems) {
                        var f = "";
                        for (var d = 0; d < b.length; d++) {
                            var e = b[d].value;
                            if (e == null) {
                                e = b[d].label;
                            }
                            if (d == b.length - 1) {
                                f += e;
                            } else {
                                f += e + ",";
                            }
                        }
                        this.input.val(f);
                    }
                }
            }
        },
        getCheckedItems: function () {
            var b = new Array();
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (d.checked) {
                    b.push(d);
                }
            });
            return b;
        },
        getUncheckedItems: function () {
            var b = new Array();
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (!d.checked) {
                    b.push(d);
                }
            });
            return b;
        },
        checkAll: function () {
            var b = this;
            a.each(b.items, function () {
                var c = this;
                if (!c.disabled) {
                    c.checked = true;
                    a(c.checkBoxElement).jqxCheckBox("_setState", true);
                }
            });
            this._raiseEvent("6", { element: this, checked: true });
        },
        uncheckAll: function () {
            var b = this;
            a.each(b.items, function () {
                var c = this;
                if (!c.disabled) {
                    c.checked = false;
                    a(c.checkBoxElement).jqxCheckBox("_setState", false);
                }
            });
            this._raiseEvent("6", { element: this, checked: false });
        },
        checkItem: function (d, f, b) {
            if (d == null) {
                return false;
            }
            if (f === undefined) {
                f = true;
            }
            if (d.treeInstance != undefined) {
                d = d.element;
            }
            var e = this;
            var c = false;
            var g = null;
            a.each(e.items, function () {
                var h = this;
                if (h.element == d && !h.disabled) {
                    c = true;
                    h.checked = f;
                    g = h;
                    a(h.checkBoxElement).jqxCheckBox({ checked: f });
                    return false;
                }
            });
            if (c) {
                this._raiseEvent("6", { element: d, checked: f });
                this._updateInputSelection();
            }
            if (b == undefined) {
                if (g) {
                    if (this.hasThreeStates) {
                        this.checkItems(g, g);
                    }
                }
            }
        },
        uncheckItem: function (b) {
            this.checkItem(b, false);
        },
        enableItem: function (b) {
            if (b == null) {
                return false;
            }
            if (b.treeInstance != undefined) {
                b = b.element;
            }
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (d.element == b) {
                    d.disabled = false;
                    a(d.titleElement).removeClass(
                        c.toThemeProperty("jqx-fill-state-disabled")
                    );
                    a(d.titleElement).removeClass(
                        c.toThemeProperty("jqx-tree-item-disabled")
                    );
                    if (c.checkboxes && d.checkBoxElement) {
                        a(d.checkBoxElement).jqxCheckBox({ disabled: false });
                    }
                    return false;
                }
            });
        },
        enableAll: function () {
            var b = this;
            a.each(b.items, function () {
                var c = this;
                c.disabled = false;
                a(c.titleElement).removeClass(
                    b.toThemeProperty("jqx-tree-item-disabled")
                );
                a(c.titleElement).removeClass(
                    b.toThemeProperty("jqx-fill-state-disabled")
                );
                if (b.checkboxes && c.checkBoxElement) {
                    a(c.checkBoxElement).jqxCheckBox({ disabled: false });
                }
            });
        },
        lockItem: function (b) {
            if (b == null) {
                return false;
            }
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (d.element == b) {
                    d.locked = true;
                    return false;
                }
            });
        },
        unlockItem: function (b) {
            if (b == null) {
                return false;
            }
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (d.element == b) {
                    d.locked = false;
                    return false;
                }
            });
        },
        getItems: function () {
            return this.items;
        },
        getItem: function (b) {
            if (b == null || b == undefined) {
                return null;
            }
            if (this.itemMapping["id" + b.id]) {
                var c = this.itemMapping["id" + b.id].item;
                return c;
            }
            return null;
        },
        isExpanded: function (b) {
            if (b == null || b == undefined) {
                return false;
            }
            var c = this.itemMapping["id" + b.id].item;
            if (c != null) {
                return c.isExpanded;
            }
            return false;
        },
        isSelected: function (b) {
            if (b == null || b == undefined) {
                return false;
            }
            var c = this.itemMapping["id" + b.id].item;
            if (c != null) {
                return c == this.selectedItem;
            }
            return false;
        },
        getPrevItem: function (c) {
            var d = this.getItem(c);
            if (c.treeInstance != undefined) {
                d = c;
            }
            var b = this._prevVisibleItem(d);
            return b;
        },
        getNextItem: function (c) {
            var d = this.getItem(c);
            if (c.treeInstance != undefined) {
                d = c;
            }
            var b = this._nextVisibleItem(d);
            return b;
        },
        getSelectedItem: function (b) {
            return this.selectedItem;
        },
        val: function (d) {
            if (arguments.length == 0 || typeof d == "object") {
                return this.selectedItem;
            }
            if (typeof d == "string") {
                var b = this.host.find("#" + d);
                if (b.length > 0) {
                    var c = this.getItem(b[0]);
                    this.selectItem(c);
                }
            } else {
                var c = this.getItem(d);
                this.selectItem(c);
            }
        },
        getActiveDescendant: function () {
            if (this.selectedItem) {
                return this.selectedItem.element.id;
            }
            return "";
        },
        clearSelection: function () {
            this.selectItem(null);
        },
        selectItem: function (b, c) {
            if (this.disabled) {
                return;
            }
            var d = this;
            if (b && b.treeInstance != undefined) {
                b = b.element;
            }
            if (b == null || b == undefined) {
                if (d.selectedItem != null) {
                    a(d.selectedItem.titleElement).removeClass(
                        d.toThemeProperty("jqx-fill-state-pressed")
                    );
                    a(d.selectedItem.titleElement).removeClass(
                        d.toThemeProperty("jqx-tree-item-selected")
                    );
                    d.selectedItem = null;
                }
                return;
            }
            if (this.selectedItem != null && this.selectedItem.element == b) {
                return;
            }
            var e =
                this.selectedItem != null ? this.selectedItem.element : null;
            if (e) {
                a(e).removeAttr("aria-selected");
            }
            a.each(d.items, function () {
                var f = this;
                this.selected = false;
                if (!f.disabled) {
                    if (f.element == b) {
                        if (
                            d.selectedItem == null ||
                            (d.selectedItem != null &&
                                d.selectedItem.titleElement != f.titleElement)
                        ) {
                            if (d.selectedItem != null) {
                                a(d.selectedItem.titleElement).removeClass(
                                    d.toThemeProperty("jqx-fill-state-pressed")
                                );
                                a(d.selectedItem.titleElement).removeClass(
                                    d.toThemeProperty("jqx-tree-item-selected")
                                );
                            }
                            a(f.titleElement).addClass(
                                d.toThemeProperty("jqx-fill-state-pressed")
                            );
                            a(f.titleElement).addClass(
                                d.toThemeProperty("jqx-tree-item-selected")
                            );
                            d.selectedItem = f;
                            this.selected = true;
                            a(f.element).attr("aria-selected", "true");
                            a.jqx.aria(
                                d,
                                "aria-activedescendant",
                                f.element.id
                            );
                        }
                    }
                }
            });
            this._updateInputSelection();
            if (!c) {
                c = null;
            }
            this._raiseEvent("2", { element: b, prevElement: e, type: c });
        },
        collapseAll: function () {
            this.isUpdating = true;
            var d = this;
            var b = d.items;
            var c = this.animationHideDuration;
            this.animationHideDuration = 0;
            a.each(b, function () {
                var e = this;
                if (e.isExpanded == true) {
                    d._collapseItem(d, e);
                }
            });
            setTimeout(function () {
                d.isUpdating = false;
                d._calculateWidth();
            }, this.animationHideDuration);
            this.animationHideDuration = c;
        },
        expandAll: function () {
            var c = this;
            this.isUpdating = true;
            var b = this.animationShowDuration;
            this.animationShowDuration = 0;
            a.each(this.items, function () {
                var d = this;
                if (d.hasItems) {
                    c._expandItem(c, d);
                }
            });
            setTimeout(function () {
                c.isUpdating = false;
                c._calculateWidth();
            }, this.animationShowDuration);
            this.animationShowDuration = b;
        },
        collapseItem: function (b) {
            if (b == null) {
                return false;
            }
            if (b.treeInstance != undefined) {
                b = b.element;
            }
            var c = this;
            a.each(this.items, function () {
                var d = this;
                if (d.isExpanded == true && d.element == b) {
                    c._collapseItem(c, d);
                    return false;
                }
            });
            return true;
        },
        expandItem: function (b) {
            if (b == null) {
                return false;
            }
            if (b.treeInstance != undefined) {
                b = b.element;
            }
            var c = this;
            a.each(c.items, function () {
                var d = this;
                if (
                    d.isExpanded == false &&
                    d.element == b &&
                    !d.disabled &&
                    !d.locked
                ) {
                    c._expandItem(c, d);
                    if (d.parentElement) {
                        c.expandItem(d.parentElement);
                    }
                }
            });
            return true;
        },
        _getClosedSubtreeOffset: function (c) {
            var b = a(c.subtreeElement);
            var e = -b.outerHeight();
            var d = -b.outerWidth();
            d = 0;
            return { left: d, top: e };
        },
        _collapseItem: function (g, k, d, b) {
            if (g == null || k == null) {
                return false;
            }
            if (k.disabled) {
                return false;
            }
            if (g.disabled) {
                return false;
            }
            if (g.locked) {
                return false;
            }
            var e = a(k.subtreeElement);
            var l = this._getClosedSubtreeOffset(k);
            var h = l.top;
            var c = l.left;
            var j = a(k.element);
            var f = g.animationHideDelay;
            f = 0;
            if (e.data("timer").show != null) {
                clearTimeout(e.data("timer").show);
                e.data("timer").show = null;
            }
            var i = function () {
                k.isExpanded = false;
                if (g.checkboxes) {
                    var n = e.find(".chkbox");
                    n.stop();
                    n.css("opacity", 1);
                    e.find(".chkbox").animate({ opacity: 0 }, 50);
                }
                var m = a(k.arrow);
                g._arrowStyle(m, "", k.isExpanded);
                e.slideUp(g.animationHideDuration, function () {
                    k.isCollapsing = false;
                    g._calculateWidth();
                    var o = a(k.arrow);
                    g._arrowStyle(o, "", k.isExpanded);
                    e.hide();
                    g._raiseEvent("1", { element: k.element });
                });
            };
            if (f > 0) {
                e.data("timer").hide = setTimeout(function () {
                    i();
                }, f);
            } else {
                i();
            }
        },
        _expandItem: function (g, j) {
            if (g == null || j == null) {
                return false;
            }
            if (j.isExpanded) {
                return false;
            }
            if (j.locked) {
                return false;
            }
            if (j.disabled) {
                return false;
            }
            if (g.disabled) {
                return false;
            }
            var e = a(j.subtreeElement);
            if (e.data("timer") != null && e.data("timer").hide != null) {
                clearTimeout(e.data("timer").hide);
            }
            var i = a(j.element);
            var h = 0;
            var d = 0;
            if (parseInt(e.css("top")) == h) {
                j.isExpanded = true;
                return;
            }
            var c = a(j.arrow);
            g._arrowStyle(c, "", j.isExpanded);
            if (g.checkboxes) {
                var f = e.find(".chkbox");
                f.stop();
                f.css("opacity", 0);
                f.animate({ opacity: 1 }, g.animationShowDuration);
            }
            var c = a(j.arrow);
            g._arrowStyle(c, "", true);
            e.slideDown(g.animationShowDuration, g.easing, function () {
                var k = a(j.arrow);
                j.isExpanded = true;
                g._arrowStyle(k, "", j.isExpanded);
                j.isExpanding = false;
                g._raiseEvent("0", { element: j.element });
                g._calculateWidth();
            });
            if (g.checkboxes) {
                g._updateCheckItemLayout(j);
                if (j.subtreeElement) {
                    var b = a(j.subtreeElement).find("li");
                    a.each(b, function () {
                        var k = g.getItem(this);
                        if (k != null) {
                            g._updateCheckItemLayout(k);
                        }
                    });
                }
            }
        },
        _calculateWidth: function () {
            var f = this;
            var g = this.checkboxes ? 20 : 0;
            var e = 0;
            if (this.isUpdating) {
                return;
            }
            a.each(this.items, function () {
                var h = a(this.element).height();
                if (h != 0) {
                    var k =
                        a(this.titleElement).outerWidth() +
                        10 +
                        g +
                        (1 + this.level) * 20;
                    e = Math.max(e, k);
                    if (this.hasItems) {
                        var i = parseInt(
                            a(this.titleElement).css("padding-top")
                        );
                        if (isNaN(i)) {
                            i = 0;
                        }
                        i = i * 2;
                        i += 2;
                        var j =
                            (i + a(this.titleElement).height()) / 2 - 17 / 2;
                        if (a.jqx.browser.msie && a.jqx.browser.version < 9) {
                            a(this.arrow).css("margin-top", "3px");
                        } else {
                            if (parseInt(j) >= 0) {
                                a(this.arrow).css(
                                    "margin-top",
                                    parseInt(j) + "px"
                                );
                            }
                        }
                    }
                }
            });
            if (this.toggleIndicatorSize > 16) {
                e = e + this.toggleIndicatorSize - 16;
            }
            if (f.panel) {
                if (e > this.host.width()) {
                    var b = e - this.host.width();
                    var d =
                        f.panel.jqxPanel("vScrollBar").css("visibility") !==
                        "hidden"
                            ? 10
                            : 0;
                    b += d;
                    f.panel.jqxPanel({ horizontalScrollBarMax: b });
                } else {
                    f.panel.jqxPanel({ horizontalScrollBarMax: 0 });
                }
            }
            this.host.find("ul:first").width(e);
            var c = this.host.width() - 30;
            if (c > 0) {
                this.host.find("ul:first").css("min-width", c);
            }
            if (f.panel) {
                f.panel.jqxPanel("_arrange");
            }
        },
        _arrowStyle: function (c, h, b) {
            var e = this;
            if (c.length > 0) {
                c.removeClass();
                var g = "";
                if (h == "hover") {
                    g = "-" + h;
                }
                var f = b ? "-expand" : "-collapse";
                var d = "jqx-tree-item-arrow" + f + g;
                c.addClass(e.toThemeProperty(d));
                if (!this.rtl) {
                    var f = !b ? "-right" : "-down";
                    c.addClass(e.toThemeProperty("jqx-icon-arrow" + f + ""));
                }
                if (this.rtl) {
                    c.addClass(e.toThemeProperty(d + "-rtl"));
                    var f = !b ? "-left" : "-down";
                    c.addClass(e.toThemeProperty("jqx-icon-arrow" + f + ""));
                }
            }
        },
        _initialize: function (f, c) {
            var e = this;
            var d = 0;
            this.host.addClass(e.toThemeProperty("jqx-widget"));
            this.host.addClass(e.toThemeProperty("jqx-widget-content"));
            this.host.addClass(e.toThemeProperty("jqx-tree"));
            this._updateDisabledState();
            var b = a.jqx.browser.msie && a.jqx.browser.version < 8;
            a.each(this.items, function () {
                var m = this;
                var g = a(m.element);
                var k = null;
                if (e.checkboxes && !m.hasItems && m.checkBoxElement) {
                    a(m.checkBoxElement).css("margin-left", "0px");
                }
                if (!b) {
                    if (!m.hasItems) {
                        if (!e.rtl) {
                            m.element.style.marginLeft =
                                parseInt(e.toggleIndicatorSize) + "px";
                        } else {
                            m.element.style.marginRight =
                                parseInt(e.toggleIndicatorSize) + "px";
                        }
                        var j = a(m.arrow);
                        if (j.length > 0) {
                            j.remove();
                            m.arrow = null;
                        }
                        return true;
                    } else {
                        if (!e.rtl) {
                            m.element.style.marginLeft = "0px";
                        } else {
                            m.element.style.marginRight = "0px";
                        }
                    }
                } else {
                    if (!m.hasItems && a(m.element).find("ul").length > 0) {
                        a(m.element).find("ul").remove();
                    }
                }
                var j = a(m.arrow);
                if (j.length > 0) {
                    j.remove();
                }
                var k = a(
                    '<span style="height: 17px; border: none; background-color: transparent;" id="arrow' +
                        g[0].id +
                        '"></span>'
                );
                k.prependTo(g);
                if (!e.rtl) {
                    k.css("float", "left");
                } else {
                    k.css("float", "right");
                }
                k.css("clear", "both");
                k.width(e.toggleIndicatorSize);
                e._arrowStyle(k, "", m.isExpanded);
                var l = parseInt(a(this.titleElement).css("padding-top"));
                if (isNaN(l)) {
                    l = 0;
                }
                l = l * 2;
                l += 2;
                var n = (l + a(this.titleElement).height()) / 2 - 17 / 2;
                if (a.jqx.browser.msie && a.jqx.browser.version < 9) {
                    k.css("margin-top", "3px");
                } else {
                    if (parseInt(n) >= 0) {
                        k.css("margin-top", parseInt(n) + "px");
                    }
                }
                g.addClass(e.toThemeProperty("jqx-disableselect"));
                k.addClass(e.toThemeProperty("jqx-disableselect"));
                var h = "click";
                var i = e.isTouchDevice();
                if (i) {
                    h = a.jqx.mobile.getTouchEventName("touchend");
                }
                e.addHandler(k, h, function () {
                    if (!m.isExpanded) {
                        e._expandItem(e, m);
                    } else {
                        e._collapseItem(e, m);
                    }
                    return false;
                });
                e.addHandler(k, "selectstart", function () {
                    return false;
                });
                e.addHandler(k, "mouseup", function () {
                    if (!i) {
                        return false;
                    }
                });
                m.hasItems = a(m.element).find("li").length > 0;
                m.arrow = k[0];
                if (!m.hasItems) {
                    k.css("visibility", "hidden");
                }
                g.css("float", "none");
            });
        },
        _getOffset: function (b) {
            var f = a(window).scrollTop();
            var h = a(window).scrollLeft();
            var c = a.jqx.mobile.isSafariMobileBrowser();
            var g = a(b).offset();
            var e = g.top;
            var d = g.left;
            if (c != null && c) {
                return { left: d - h, top: e - f };
            } else {
                return a(b).offset();
            }
        },
        _renderHover: function (c, e, b) {
            var d = this;
            if (!b) {
                var f = a(e.titleElement);
                d.addHandler(f, "mouseenter", function () {
                    if (!e.disabled && d.enableHover && !d.disabled) {
                        f.addClass(d.toThemeProperty("jqx-fill-state-hover"));
                        f.addClass(d.toThemeProperty("jqx-tree-item-hover"));
                    }
                });
                d.addHandler(f, "mouseleave", function () {
                    if (!e.disabled && d.enableHover && !d.disabled) {
                        f.removeClass(
                            d.toThemeProperty("jqx-fill-state-hover")
                        );
                        f.removeClass(d.toThemeProperty("jqx-tree-item-hover"));
                    }
                });
            }
        },
        _updateDisabledState: function () {
            if (this.disabled) {
                this.host.addClass(
                    this.toThemeProperty("jqx-fill-state-disabled")
                );
            } else {
                this.host.removeClass(
                    this.toThemeProperty("jqx-fill-state-disabled")
                );
            }
        },
        _addInput: function () {
            if (this.input == null) {
                var b = this.host.attr("name");
                if (b) {
                    this.host.attr("name", "");
                }
                this.input = a("<input type='hidden'/>");
                this.host.append(this.input);
                this.input.attr("name", b);
                this._updateInputSelection();
            }
        },
        render: function () {
            this._updateItemsNavigation();
            this._render();
        },
        _render: function (f, i) {
            if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                var g = this;
                a.each(this.items, function () {
                    var m = a(this.element);
                    var o = m.parent();
                    var l =
                        parseInt(this.titleElement.css("margin-left")) +
                        this.titleElement[0].scrollWidth +
                        13;
                    m.css("min-width", l);
                    var n = parseInt(o.css("min-width"));
                    if (isNaN(n)) {
                        n = 0;
                    }
                    var k = m.css("min-width");
                    if (n < parseInt(m.css("min-width"))) {
                        o.css("min-width", k);
                    }
                    this.titleElement[0].style.width = null;
                });
            }
            var h = 1000;
            var c = [5, 5];
            var g = this;
            a.data(g.element, "animationHideDelay", g.animationHideDelay);
            a.data(document.body, "treeel", this);
            this._initialize();
            var d = this.isTouchDevice();
            if (d && this.toggleMode == "dblclick") {
                this.toggleMode = "click";
            }
            if (f == undefined || f == true) {
                a.each(this.items, function () {
                    g._updateItemEvents(g, this);
                });
            }
            if (
                this.allowDrag &&
                this._enableDragDrop &&
                (i == undefined || i == true)
            ) {
                this._enableDragDrop();
            }
            this._addInput();
            if (this.host.jqxPanel) {
                if (this.host.find("#panel" + this.element.id).length > 0) {
                    this.panel.jqxPanel({ touchMode: this.touchMode });
                    this.panel.jqxPanel("refresh");
                    return;
                }
                this.host
                    .find("ul:first")
                    .wrap(
                        '<div style="background-color: transparent; overflow: hidden; width: 100%; height: 100%;" id="panel' +
                            this.element.id +
                            '"></div>'
                    );
                var b = this.host.find("div:first");
                var j = "fixed";
                if (this.height == null || this.height == "auto") {
                    j = "verticalwrap";
                }
                if (this.width == null || this.width == "auto") {
                    if (j == "fixed") {
                        j = "horizontalwrap";
                    } else {
                        j = "wrap";
                    }
                }
                b.jqxPanel({
                    rtl: this.rtl,
                    theme: this.theme,
                    width: "100%",
                    height: "100%",
                    touchMode: this.touchMode,
                    sizeMode: j,
                });
                if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                    b.jqxPanel("content").css("left", "0px");
                }
                b.data({ nestedWidget: true });
                if (
                    this.height == null ||
                    (this.height != null &&
                        this.height.toString().indexOf("%") != -1)
                ) {
                    if (this.isTouchDevice()) {
                        this.removeHandler(
                            b,
                            a.jqx.mobile.getTouchEventName("touchend") +
                                ".touchScroll touchcancel.touchScroll"
                        );
                        this.removeHandler(
                            b,
                            a.jqx.mobile.getTouchEventName("touchmove") +
                                ".touchScroll"
                        );
                        this.removeHandler(
                            b,
                            a.jqx.mobile.getTouchEventName("touchstart") +
                                ".touchScroll"
                        );
                    }
                }
                var e = a.data(b[0], "jqxPanel").instance;
                if (e != null) {
                    this.vScrollInstance = e.vScrollInstance;
                    this.hScrollInstance = e.hScrollInstance;
                }
                this.panelInstance = e;
                if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                    this.host.attr("hideFocus", true);
                    this.host.find("div").attr("hideFocus", true);
                    this.host.find("ul").attr("hideFocus", true);
                }
                b[0].className = "";
                this.panel = b;
            }
            this._raiseEvent("3", this);
        },
        focus: function () {
            try {
                this.host.focus();
            } catch (b) {}
        },
        _updateItemEvents: function (h, j) {
            var b = this.isTouchDevice();
            if (b) {
                this.toggleMode = a.jqx.mobile.getTouchEventName("touchend");
            }
            var i = a(j.element);
            if (h.enableRoundedCorners) {
                i.addClass(h.toThemeProperty("jqx-rc-all"));
            }
            var e = !b
                ? "mousedown"
                : a.jqx.mobile.getTouchEventName("touchend");
            if (h.touchMode === true) {
                h.removeHandler(a(j.checkBoxElement), "mousedown");
            }
            h.removeHandler(a(j.checkBoxElement), e);
            h.addHandler(a(j.checkBoxElement), e, function (k) {
                if (!h.disabled) {
                    if (!this.treeItem.disabled) {
                        this.treeItem.checked = !this.treeItem.checked;
                        h.checkItem(
                            this.treeItem.element,
                            this.treeItem.checked,
                            "tree"
                        );
                        if (h.hasThreeStates) {
                            h.checkItems(this.treeItem, this.treeItem);
                        }
                    }
                }
                return false;
            });
            var c = a(j.titleElement);
            h.removeHandler(i);
            var f = this.allowDrag && this._enableDragDrop;
            if (!f) {
                h.removeHandler(c);
            } else {
                h.removeHandler(c, "mousedown.item");
                h.removeHandler(c, "click");
                h.removeHandler(c, "dblclick");
                h.removeHandler(c, "mouseenter");
                h.removeHandler(c, "mouseleave");
            }
            h._renderHover(i, j, b);
            var d = a(j.subtreeElement);
            if (d.length > 0) {
                var g = j.isExpanded ? "block" : "none";
                d.css({ overflow: "hidden", display: g });
                d.data("timer", {});
            }
            h.addHandler(c, "selectstart", function (k) {
                return false;
            });
            if (a.jqx.browser.opera) {
                h.addHandler(c, "mousedown.item", function (k) {
                    return false;
                });
            }
            if (h.toggleMode != "click") {
                h.addHandler(c, "click", function (k) {
                    h.selectItem(j.element, "mouse");
                    if (h.panel != null) {
                        h.panel.jqxPanel({ focused: true });
                    }
                    c.focus();
                    h._raiseEvent("9", { element: j.element });
                });
            }
            h.addHandler(c, h.toggleMode, function (k) {
                if (d.length > 0) {
                    clearTimeout(d.data("timer").hide);
                }
                if (h.panel != null) {
                    h.panel.jqxPanel({ focused: true });
                }
                h.selectItem(j.element, "mouse");
                if (j.isExpanding == undefined) {
                    j.isExpanding = false;
                }
                if (j.isCollapsing == undefined) {
                    j.isCollapsing = false;
                }
                if (d.length > 0) {
                    if (!j.isExpanded) {
                        if (false == j.isExpanding) {
                            j.isExpanding = true;
                            h._expandItem(h, j);
                        }
                    } else {
                        if (false == j.isCollapsing) {
                            j.isCollapsing = true;
                            h._collapseItem(h, j, true);
                        }
                    }
                    return false;
                }
            });
        },
        isTouchDevice: function () {
            if (this._isTouchDevice != undefined) {
                return this._isTouchDevice;
            }
            var b = a.jqx.mobile.isTouchDevice();
            if (this.touchMode == true) {
                b = true;
            } else {
                if (this.touchMode == false) {
                    b = false;
                }
            }
            this._isTouchDevice = b;
            return b;
        },
        createID: function () {
            return a.jqx.utilities.createId();
        },
        createTree: function (b) {
            if (b == null) {
                return;
            }
            var d = this;
            var f = a(b).find("li");
            var c = 0;
            this.items = new Array();
            this.itemMapping = new Array();
            a(b).addClass(d.toThemeProperty("jqx-tree-dropdown-root"));
            if (this.rtl) {
                a(b).addClass(d.toThemeProperty("jqx-tree-dropdown-root-rtl"));
            }
            if (this.rtl || (a.jqx.browser.msie && a.jqx.browser.version < 8)) {
                this._measureItem = a(
                    "<span style='position: relative; visibility: hidden;'></span>"
                );
                this._measureItem.addClass(this.toThemeProperty("jqx-widget"));
                this._measureItem.addClass(
                    this.toThemeProperty("jqx-fill-state-normal")
                );
                this._measureItem.addClass(
                    this.toThemeProperty("jqx-tree-item")
                );
                this._measureItem.addClass(this.toThemeProperty("jqx-item"));
                a(document.body).append(this._measureItem);
            }
            if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
            }
            for (var e = 0; e < f.length; e++) {
                this._createItem(f[e]);
            }
            if (this.rtl || (a.jqx.browser.msie && a.jqx.browser.version < 8)) {
                this._measureItem.remove();
            }
            this._updateItemsNavigation();
            this._updateCheckStates();
        },
        _updateCheckLayout: function (c) {
            var b = this;
            if (!this.checkboxes) {
                return;
            }
            a.each(this.items, function () {
                if (this.level == c || c == undefined) {
                    b._updateCheckItemLayout(this);
                }
            });
        },
        _updateCheckItemLayout: function (b) {
            if (this.checkboxes) {
                if (a(b.titleElement).css("display") != "none") {
                    var c = a(b.checkBoxElement);
                    var d =
                        a(b.titleElement).outerHeight() / 2 -
                        1 -
                        parseInt(this.checkSize) / 2;
                    c.css("margin-top", d);
                    if (!this.rtl) {
                        if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                            b.titleElement.css(
                                "margin-left",
                                parseInt(this.checkSize) + 25
                            );
                        } else {
                            if (b.hasItems) {
                                c.css("margin-left", this.toggleIndicatorSize);
                            }
                        }
                    }
                }
            }
        },
        _updateCheckStates: function () {
            var b = this;
            if (b.hasThreeStates) {
                a.each(this.items, function () {
                    b._updateCheckState(this);
                });
            } else {
                a.each(this.items, function () {
                    if (this.checked == null) {
                        b.checkItem(this.element, false, "tree");
                    }
                });
            }
        },
        _updateCheckState: function (e) {
            if (e == null || e == undefined) {
                return;
            }
            var d = this;
            var c = 0;
            var f = false;
            var b = 0;
            var g = a(e.element).find("li");
            b = g.length;
            if (e.checked && b > 0) {
                a.each(g, function (h) {
                    var j = d.itemMapping["id" + this.id].item;
                    var i = j.element.getAttribute("item-checked");
                    if (
                        i == undefined ||
                        i == null ||
                        i == "true" ||
                        i == true
                    ) {
                        d.checkItem(j.element, true, "tree");
                    }
                });
            }
            a.each(g, function (h) {
                var i = d.itemMapping["id" + this.id].item;
                if (i.checked != false) {
                    if (i.checked == null) {
                        f = true;
                    }
                    c++;
                }
            });
            if (b > 0) {
                if (c == b) {
                    this.checkItem(e.element, true, "tree");
                } else {
                    if (c > 0) {
                        this.checkItem(e.element, null, "tree");
                    } else {
                        this.checkItem(e.element, false, "tree");
                    }
                }
            }
        },
        _updateItemsNavigation: function () {
            var g = this.host.find("ul:first");
            var f = a(g).find("li");
            var c = 0;
            for (var d = 0; d < f.length; d++) {
                var b = f[d];
                if (this.itemMapping["id" + b.id]) {
                    var e = this.itemMapping["id" + b.id].item;
                    if (!e) {
                        continue;
                    }
                    e.prevItem = null;
                    e.nextItem = null;
                    if (d > 0) {
                        if (this.itemMapping["id" + f[d - 1].id]) {
                            e.prevItem = this.itemMapping[
                                "id" + f[d - 1].id
                            ].item;
                        }
                    }
                    if (d < f.length - 1) {
                        if (this.itemMapping["id" + f[d + 1].id]) {
                            e.nextItem = this.itemMapping[
                                "id" + f[d + 1].id
                            ].item;
                        }
                    }
                }
            }
        },
        _applyTheme: function (e, h) {
            var f = this;
            this.host.removeClass("jqx-tree-" + e);
            this.host.removeClass("jqx-widget-" + e);
            this.host.removeClass("jqx-widget-content-" + e);
            this.host.addClass(f.toThemeProperty("jqx-tree"));
            this.host.addClass(f.toThemeProperty("jqx-widget"));
            var b = this.host.find("ul:first");
            a(b).removeClass(f.toThemeProperty("jqx-tree-dropdown-root-" + e));
            a(b).addClass(f.toThemeProperty("jqx-tree-dropdown-root"));
            if (this.rtl) {
                a(b).removeClass(
                    f.toThemeProperty("jqx-tree-dropdown-root-rtl-" + e)
                );
                a(b).addClass(f.toThemeProperty("jqx-tree-dropdown-root-rtl"));
            }
            var g = a(b).find("li");
            for (var d = 0; d < g.length; d++) {
                var c = g[d];
                a(c)
                    .children()
                    .each(function () {
                        if (this.tagName == "ul" || this.tagName == "UL") {
                            a(this).removeClass(
                                f.toThemeProperty("jqx-tree-dropdown-" + e)
                            );
                            a(this).addClass(
                                f.toThemeProperty("jqx-tree-dropdown")
                            );
                            if (f.rtl) {
                                a(this).removeClass(
                                    f.toThemeProperty(
                                        "jqx-tree-dropdown-rtl-" + e
                                    )
                                );
                                a(this).addClass(
                                    f.toThemeProperty("jqx-tree-dropdown-rtl")
                                );
                            }
                            return false;
                        }
                    });
            }
            a.each(this.items, function () {
                var k = this;
                var j = a(k.element);
                j.removeClass(f.toThemeProperty("jqx-tree-item-li-" + e));
                j.addClass(f.toThemeProperty("jqx-tree-item-li"));
                if (this.rtl) {
                    j.removeClass(f.toThemeProperty("jqx-tree-item-li-" + e));
                    j.addClass(f.toThemeProperty("jqx-tree-item-li"));
                }
                a(k.titleElement).removeClass(
                    f.toThemeProperty("jqx-tree-item-" + e)
                );
                a(k.titleElement).addClass(f.toThemeProperty("jqx-tree-item"));
                a(k.titleElement).removeClass("jqx-item-" + e);
                a(k.titleElement).addClass(f.toThemeProperty("jqx-item"));
                var i = a(k.arrow);
                if (i.length > 0) {
                    f._arrowStyle(i, "", k.isExpanded);
                }
                if (k.checkBoxElement) {
                    a(k.checkBoxElement).jqxCheckBox({ theme: h });
                }
                if (f.enableRoundedCorners) {
                    j.removeClass("jqx-rc-all-" + e);
                    j.addClass(f.toThemeProperty("jqx-rc-all"));
                }
            });
            if (this.host.jqxPanel) {
                this.panel.jqxPanel({ theme: h });
            }
        },
        _refreshMapping: function (f, p) {
            var e = this.host.find("li");
            var b = new Array();
            var o = new Array();
            var h = a.data(document.body, "treeItemsStorage");
            var k = this;
            for (var i = 0; i < e.length; i++) {
                var j = e[i];
                var d = a(j);
                var n = h[j.id];
                if (n == null) {
                    continue;
                }
                o[o.length] = n;
                if (f == undefined || f == true) {
                    this._updateItemEvents(this, n);
                }
                n.level = d.parents("li").length;
                n.treeInstance = this;
                var m = null;
                var g = null;
                if (
                    n.titleElement[0].className.indexOf(
                        "jqx-fill-state-pressed"
                    ) != -1
                ) {
                    a(n.titleElement).removeClass(
                        k.toThemeProperty("jqx-fill-state-pressed")
                    );
                    a(n.titleElement).removeClass(
                        k.toThemeProperty("jqx-tree-item-selected")
                    );
                }
                var c = d.children();
                c.each(function () {
                    if (this.tagName == "ul" || this.tagName == "UL") {
                        n.subtreeElement = this;
                        a(this).addClass(
                            k.toThemeProperty("jqx-tree-dropdown")
                        );
                        if (k.rtl) {
                            a(this).addClass(
                                k.toThemeProperty("jqx-tree-dropdown-rtl")
                            );
                        }
                        return false;
                    }
                });
                var l = d.parents();
                l.each(function () {
                    if (this.tagName == "li" || this.tagName == "LI") {
                        g = this.id;
                        m = this;
                        return false;
                    }
                });
                n.parentElement = m;
                n.parentId = g;
                n.hasItems = a(n.element).find("li").length > 0;
                if (n != null) {
                    b[i] = { element: j, item: n };
                    b["id" + j.id] = b[i];
                }
            }
            this.itemMapping = b;
            this.items = o;
        },
        _createItem: function (c) {
            if (c == null || c == undefined) {
                return;
            }
            var q = c.id;
            if (!q) {
                q = this.createID();
            }
            var E = c;
            var l = a(c);
            E.id = q;
            var g = a.data(document.body, "treeItemsStorage");
            if (g == undefined) {
                g = new Array();
            }
            var w = this.items.length;
            this.items[w] = new a.jqx._jqxTree.jqxTreeItem();
            this.treeElements[q] = this.items[w];
            g[E.id] = this.items[w];
            a.data(document.body, "treeItemsStorage", g);
            w = this.items.length;
            var z = 0;
            var G = this;
            var e = null;
            l.attr("role", "treeitem");
            l.children().each(function () {
                if (this.tagName == "ul" || this.tagName == "UL") {
                    G.items[w - 1].subtreeElement = this;
                    a(this).addClass(G.toThemeProperty("jqx-tree-dropdown"));
                    if (G.rtl) {
                        a(this).addClass(
                            G.toThemeProperty("jqx-tree-dropdown-rtl")
                        );
                        a(this).css("clear", "both");
                    }
                    return false;
                }
            });
            l.parents().each(function () {
                if (this.tagName == "li" || this.tagName == "LI") {
                    z = this.id;
                    e = this;
                    return false;
                }
            });
            var v = c.getAttribute("item-expanded");
            if (v == null || v == undefined || (v != "true" && v != true)) {
                v = false;
            } else {
                v = true;
            }
            E.removeAttribute("item-expanded");
            var F = c.getAttribute("item-locked");
            if (F == null || F == undefined || (F != "true" && F != true)) {
                F = false;
            } else {
                F = true;
            }
            E.removeAttribute("item-locked");
            var r = c.getAttribute("item-selected");
            if (r == null || r == undefined || (r != "true" && r != true)) {
                r = false;
            } else {
                r = true;
            }
            E.removeAttribute("item-selected");
            var d = c.getAttribute("item-disabled");
            if (d == null || d == undefined || (d != "true" && d != true)) {
                d = false;
            } else {
                d = true;
            }
            E.removeAttribute("item-disabled");
            var i = c.getAttribute("item-checked");
            if (i == null || i == undefined || (i != "true" && i != true)) {
                i = false;
            } else {
                i = true;
            }
            var H = c.getAttribute("item-title");
            if (H == null || H == undefined || (H != "true" && H != true)) {
                H = false;
            }
            E.removeAttribute("item-title");
            var C = c.getAttribute("item-icon");
            var s = c.getAttribute("item-iconsize");
            var j = c.getAttribute("item-label");
            var u = c.getAttribute("item-value");
            E.removeAttribute("item-icon");
            E.removeAttribute("item-iconsize");
            E.removeAttribute("item-label");
            E.removeAttribute("item-value");
            var B = this.items[w - 1];
            B.id = q;
            if (B.value == undefined) {
                if (this._valueList && this._valueList[q]) {
                    B.value = this._valueList[q];
                } else {
                    B.value = u;
                }
            }
            B.icon = C;
            B.iconsize = s;
            B.parentId = z;
            B.disabled = d;
            B.parentElement = e;
            B.element = c;
            B.locked = F;
            B.selected = r;
            B.checked = i;
            B.isExpanded = v;
            B.treeInstance = this;
            this.itemMapping[w - 1] = { element: E, item: B };
            this.itemMapping["id" + E.id] = this.itemMapping[w - 1];
            var h = false;
            var D = false;
            h = false;
            if (this.rtl) {
                a(B.element).css("float", "right");
                a(B.element).css("clear", "both");
            }
            if (!h || !D) {
                if (a(E.firstChild).length > 0) {
                    var s = 16;
                    if (B.icon) {
                        s = B.iconsize;
                        if (!s) {
                            s = 16;
                        }
                        var C = a(
                            '<img width="' +
                                s +
                                '" height="' +
                                s +
                                '" style="float: left;" class="itemicon" src="' +
                                B.icon +
                                '"/>'
                        );
                        a(E).prepend(C);
                        C.css("margin-right", "6px");
                        if (this.rtl) {
                            C.css("margin-right", "0px");
                            C.css("margin-left", "6px");
                            C.css("float", "right");
                        }
                    }
                    var b = E.innerHTML.indexOf("<ul");
                    if (b == -1) {
                        b = E.innerHTML.indexOf("<UL");
                    }
                    if (b == -1) {
                        B.originalTitle = E.innerHTML;
                        E.innerHTML =
                            '<div style="display: inline-block;">' +
                            E.innerHTML +
                            "</div>";
                        B.titleElement = a(a(E)[0].firstChild);
                    } else {
                        var A = E.innerHTML.substring(0, b);
                        A = a.trim(A);
                        B.originalTitle = A;
                        A = a(
                            '<div style="display: inline-block;">' +
                                A +
                                "</div>"
                        );
                        var n = a(E).find("ul:first");
                        n.remove();
                        E.innerHTML = "";
                        a(E).prepend(A);
                        a(E).append(n);
                        B.titleElement = A;
                        if (this.rtl) {
                            A.css("float", "right");
                            n.css("padding-right", "10px");
                        }
                    }
                    if (s !== 16) {
                        a(B.titleElement).css("line-height", s + "px");
                    }
                    if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                        a(a(E)[0].firstChild).css("display", "inline-block");
                        var m = false;
                        if (this._measureItem.parents().length == 0) {
                            a(document.body).append(this._measureItem);
                            m = true;
                        }
                        this._measureItem.css("min-width", "20px");
                        this._measureItem[0].innerHTML = a(
                            B.titleElement
                        ).text();
                        var t = this._measureItem.width();
                        if (B.icon) {
                            t += 20;
                        }
                        if (a(a(B.titleElement).find("img")).length > 0) {
                            t += 20;
                        }
                        a(a(E)[0].firstChild).css("max-width", t + "px");
                        if (m) {
                            this._measureItem.remove();
                        }
                    }
                } else {
                    B.originalTitle = "Item";
                    a(E).append(a("<span>Item</span>"));
                    a(E.firstChild).wrap("<span/>");
                    B.titleElement = a(E)[0].firstChild;
                    if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                        a(E.firstChild).css("display", "inline-block");
                    }
                }
            }
            var y = a(B.titleElement);
            var p = this.toThemeProperty("jqx-rc-all");
            if (this.allowDrag) {
                y.addClass("draggable");
            }
            if (j == null || j == undefined) {
                j = B.titleElement;
                B.label = a.trim(y.text());
            } else {
                B.label = j;
            }
            a(E).addClass(this.toThemeProperty("jqx-tree-item-li"));
            if (this.rtl) {
                a(E).addClass(this.toThemeProperty("jqx-tree-item-li-rtl"));
            }
            p +=
                " " +
                this.toThemeProperty("jqx-tree-item") +
                " " +
                this.toThemeProperty("jqx-item");
            if (this.rtl) {
                p += " " + this.toThemeProperty("jqx-tree-item-rtl");
            }
            y[0].className = y[0].className + " " + p;
            B.level = a(c).parents("li").length;
            B.hasItems = a(c).find("li").length > 0;
            if (this.rtl && B.parentElement) {
                if (!this.checkboxes) {
                }
            }
            if (this.checkboxes) {
                if (this.host.jqxCheckBox) {
                    var o = a(
                        '<div style="overflow: visible; position: absolute; width: 18px; height: 18px;" tabIndex=0 class="chkbox"/>'
                    );
                    o.width(parseInt(this.checkSize));
                    o.height(parseInt(this.checkSize));
                    a(E).prepend(o);
                    if (this.rtl) {
                        o.css("float", "right");
                        o.css("position", "static");
                    }
                    o.jqxCheckBox({
                        hasInput: false,
                        checked: B.checked,
                        boxSize: this.checkSize,
                        animationShowDelay: 0,
                        animationHideDelay: 0,
                        disabled: d,
                        theme: this.theme,
                    });
                    if (!this.rtl) {
                        y.css("margin-left", parseInt(this.checkSize) + 8);
                    } else {
                        var x = 5;
                        if (B.parentElement) {
                            o.css("margin-right", x + 5 + "px");
                        } else {
                            o.css("margin-right", x + "px");
                        }
                    }
                    B.checkBoxElement = o[0];
                    o[0].treeItem = B;
                    var f =
                        y.outerHeight() / 2 - 1 - parseInt(this.checkSize) / 2;
                    o.css("margin-top", f);
                    if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                        y.css("width", "1%");
                        y.css("margin-left", parseInt(this.checkSize) + 25);
                    } else {
                        if (B.hasItems) {
                            if (!this.rtl) {
                                o.css("margin-left", this.toggleIndicatorSize);
                            }
                        }
                    }
                } else {
                    throw new Error(
                        "jqxTree: Missing reference to jqxcheckbox.js."
                    );
                    return;
                }
            } else {
                if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                    y.css("width", "1%");
                }
            }
            if (d) {
                this.disableItem(B.element);
            }
            if (r) {
                this.selectItem(B.element);
            }
            if (a.jqx.browser.msie && a.jqx.browser.version < 8) {
                a(E).css("margin", "0px");
                a(E).css("padding", "0px");
            }
        },
        destroy: function () {
            this.removeHandler(a(window), "resize.jqxtree" + this.element.id);
            this.host.removeClass();
            if (this.isTouchDevice()) {
                this.removeHandler(
                    this.panel,
                    a.jqx.mobile.getTouchEventName("touchend") +
                        ".touchScroll touchcancel.touchScroll"
                );
                this.removeHandler(
                    this.panel,
                    a.jqx.mobile.getTouchEventName("touchmove") + ".touchScroll"
                );
                this.removeHandler(
                    this.panel,
                    a.jqx.mobile.getTouchEventName("touchstart") +
                        ".touchScroll"
                );
            }
            var c = this;
            var b = this.isTouchDevice();
            a.each(this.items, function () {
                var h = this;
                var f = a(this.element);
                var d = !b
                    ? "click"
                    : a.jqx.mobile.getTouchEventName("touchend");
                c.removeHandler(a(h.checkBoxElement), d);
                var i = a(h.titleElement);
                c.removeHandler(f);
                var g = c.allowDrag && c._enableDragDrop;
                if (!g) {
                    c.removeHandler(i);
                } else {
                    c.removeHandler(i, "mousedown.item");
                    c.removeHandler(i, "click");
                    c.removeHandler(i, "dblclick");
                    c.removeHandler(i, "mouseenter");
                    c.removeHandler(i, "mouseleave");
                }
                var e = a(h.arrow);
                if (e.length > 0) {
                    c.removeHandler(e, d);
                    c.removeHandler(e, "selectstart");
                    c.removeHandler(e, "mouseup");
                    if (!b) {
                        c.removeHandler(e, "mouseenter");
                        c.removeHandler(e, "mouseleave");
                    }
                    c.removeHandler(i, "selectstart");
                }
                if (a.jqx.browser.opera) {
                    c.removeHandler(i, "mousedown.item");
                }
                if (c.toggleMode != "click") {
                    c.removeHandler(i, "click");
                }
                c.removeHandler(i, c.toggleMode);
            });
            if (this.panel) {
                this.panel.jqxPanel("destroy");
                this.panel = null;
            }
            this.host.remove();
        },
        _raiseEvent: function (g, c) {
            if (c == undefined) {
                c = { owner: null };
            }
            var d = this.events[g];
            var e = c;
            e.owner = this;
            var f = new a.Event(d);
            f.owner = this;
            f.args = e;
            var b = this.host.trigger(f);
            return b;
        },
        propertyChangedHandler: function (d, k, b, i) {
            if (
                this.isInitialized == undefined ||
                this.isInitialized == false
            ) {
                return;
            }
            if (k == "submitCheckedItems") {
                d._updateInputSelection();
            }
            if (k == "disabled") {
                d._updateDisabledState();
            }
            if (k == "theme") {
                d._applyTheme(b, i);
            }
            if (k == "keyboardNavigation") {
                d.enableKeyboardNavigation = i;
            }
            if (k == "width" || k == "height") {
                d.refresh();
                d._initialize();
                d._calculateWidth();
                if (d.host.jqxPanel) {
                    var j = "fixed";
                    if (this.height == null || this.height == "auto") {
                        j = "verticalwrap";
                    }
                    if (this.width == null || this.width == "auto") {
                        if (j == "fixed") {
                            j = "horizontalwrap";
                        } else {
                            j = "wrap";
                        }
                    }
                    d.panel.jqxPanel({ sizeMode: j });
                }
            }
            if (k == "touchMode") {
                d._isTouchDevice = null;
                if (i) {
                    d.enableHover = false;
                }
                d._render();
            }
            if (k == "source" || k == "checkboxes") {
                if (this.source != null) {
                    var l = [];
                    a.each(d.items, function () {
                        if (this.isExpanded) {
                            l[l.length] = {
                                label: this.label,
                                level: this.level,
                            };
                        }
                    });
                    var f = d.loadItems(d.source);
                    if (!d.host.jqxPanel) {
                        d.element.innerHTML = f;
                    } else {
                        d.panel.jqxPanel("setcontent", f);
                    }
                    var e = d.disabled;
                    var g = d.host.find("ul:first");
                    if (g.length > 0) {
                        d.createTree(g[0]);
                        d._render();
                    }
                    var h = d;
                    var c = h.animationShowDuration;
                    h.animationShowDuration = 0;
                    d.disabled = false;
                    if (l.length > 0) {
                        a.each(d.items, function () {
                            for (var n = 0; n < l.length; n++) {
                                if (
                                    l[n].label == this.label &&
                                    l[n].level == this.level
                                ) {
                                    var o = h.getItem(this.element);
                                    h._expandItem(h, o);
                                }
                            }
                        });
                    }
                    d.disabled = e;
                    h.animationShowDuration = c;
                }
            }
            if (k == "hasThreeStates") {
                d._render();
                d._updateCheckStates();
            }
            if (k == "toggleIndicatorSize") {
                d._updateCheckLayout();
                d._render();
            }
        },
    });
})(jqxBaseFramework);
(function (a) {
    a.jqx._jqxTree.jqxTreeItem = function (e, d, b) {
        var c = {
            label: null,
            id: e,
            parentId: d,
            parentElement: null,
            parentItem: null,
            disabled: false,
            selected: false,
            locked: false,
            checked: false,
            level: 0,
            isExpanded: false,
            hasItems: false,
            element: null,
            subtreeElement: null,
            checkBoxElement: null,
            titleElement: null,
            arrow: null,
            prevItem: null,
            nextItem: null,
        };
        return c;
    };
})(jqxBaseFramework);
