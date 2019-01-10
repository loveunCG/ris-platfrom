/** 
 * Tool module.
 * @module tool
 */
var BAMBOO = BAMBOO || {};
BAMBOO.tool = BAMBOO.tool || {};
var Kinetic = Kinetic || {};

/**
 * Draw shape command.
 * @class DrawShapeCommand
 * @namespace BAMBOO.tool
 * @constructor
 */
BAMBOO.tool.DrawShapeCommand = function (shape, name, app)
{
    /**
     * Get the command name.
     * @method getName
     * @return {String} The command name.
     */
    this.getName = function () { return "Draw-"+name; };
    /**
     * Execute the command.
     * @method execute
     */
    this.execute = function () {
        var group = shape.getParent();
        // add the group to the layer
        app.getDrawLayer().add(group);
        // draw
        app.getDrawLayer().draw();
    };
    /**
     * Undo the command.
     * @method undo
     */
    this.undo = function () {
        var group = shape.getParent();
        // remove the group from the parent layer
        group.remove();
        // draw
        app.getDrawLayer().draw();
    };
}; // DrawShapeCommand class

/**
 * Move shape command.
 * @class MoveShapeCommand
 * @namespace BAMBOO.tool
 * @constructor
 */
BAMBOO.tool.MoveShapeCommand = function (shape, name, translation, app)
{
    /**
     * Get the command name.
     * @method getName
     * @return {String} The command name.
     */
    this.getName = function () { return "Move-"+name; };

    /**
     * Execute the command.
     * @method execute
     */
    this.execute = function () {
        var group = shape.getParent();
        // translate all children of group
        group.getChildren().each( function (shape) {
            shape.x( shape.x() + translation.x );
            shape.y( shape.y() + translation.y );
        });
        // draw
        app.getDrawLayer().draw();
    };
    /**
     * Undo the command.
     * @method undo
     */
    this.undo = function () {
        var group = shape.getParent();
        // invert translate all children of group
        group.getChildren().each( function (shape) {
            shape.x( shape.x() - translation.x );
            shape.y( shape.y() - translation.y );
        });
        // draw
        app.getDrawLayer().draw();
    };
}; // MoveShapeCommand class

/**
 * Change shape command.
 * @class ChangeShapeCommand
 * @namespace BAMBOO.tool
 * @constructor
 */
BAMBOO.tool.ChangeShapeCommand = function (shape, name, func, startAnchor, endAnchor, app)
{
    /**
     * Get the command name.
     * @method getName
     * @return {String} The command name.
     */
    this.getName = function () { return "Change-"+name; };

    /**
     * Execute the command.
     * @method execute
     */
    this.execute = function () {
        // change shape
        func( shape, endAnchor );
        // draw
        app.getDrawLayer().draw();
    };
    /**
     * Undo the command.
     * @method undo
     */
    this.undo = function () {
        // invert change shape
        func( shape, startAnchor );
        // draw
        app.getDrawLayer().draw();
    };
}; // ChangeShapeCommand class

/**
 * Delete shape command.
 * @class DeleteShapeCommand
 * @namespace BAMBOO.tool
 * @constructor
 */
BAMBOO.tool.DeleteShapeCommand = function (shape, name, app)
{
    /**
     * Get the command name.
     * @method getName
     * @return {String} The command name.
     */
    this.getName = function () { return "Delete-"+name; };
    /**
     * Execute the command.
     * @method execute
     */
    this.execute = function () {
        var group = shape.getParent();
        // remove the group from the parent layer
        group.remove();
        // draw
        app.getDrawLayer().draw();
    };
    /**
     * Undo the command.
     * @method undo
     */
    this.undo = function () {
        var group = shape.getParent();
        // add the group to the layer
        app.getDrawLayer().add(group);
        // draw
        app.getDrawLayer().draw();
    };
}; // DeleteShapeCommand class

// List of colors
BAMBOO.tool.colors = [
    "Yellow", "Red", "White", "Green", "Blue", "Lime", "Fuchsia", "Black"
];

/**
 * Drawing tool.
 * @class Draw
 * @namespace BAMBOO.tool
 * @constructor
 * @param {Object} app The associated application.
 */
BAMBOO.tool.Draw = function (app)
{
    /**
     * Closure to self: to be used by event handlers.
     * @property self
     * @private
     * @type WindowLevel
     */
    var self = this;
    /**
     * Interaction start flag.
     * @property started
     * @private
     * @type Boolean
     */
    var started = false;
    /**
     * Interaction just started flag.
     * @property justStarted
     * @private
     * @type Boolean
     */
    var justStarted = true;
    
    /**
     * Draw command.
     * @property command
     * @private
     * @type Object
     */
    var command = null;
    /**
     * Current active shape.
     * @property activeShape
     * @private
     * @type Object
     */
    var activeShape = null;
    /**
     * List of created shapes.
     * @property createdShapes
     * @private
     * @type Array
     */
    var createdShapes = [];
    /**
     * Current shape group.
     * @property shapeGroup
     * @private
     * @type Object
     */
    var shapeGroup = null;

    /**
     * Drawing style.
     * @property style
     * @type Style
     */
    this.style = new BAMBOO.html.Style();
    /**
     * Shape name.
     * @property shapeName
     * @type String
     */
    this.shapeName = 0;
    
    /**
     * List of points.
     * @property points
     * @private
     * @type Array
     */
    var points = [];
    
    /**
     * Last selected point.
     * @property lastPoint
     * @private
     * @type Object
     */
    var lastPoint = null;
    
    /**
     * Shape editor.
     * @property shapeEditor
     * @private
     * @type Object
     */
    var shapeEditor = new BAMBOO.tool.ShapeEditor();

    /**
     * Trash draw: a cross.
     * @property trash
     * @private
     * @type Object
     */
    var trash = new Kinetic.Group();

    // first line of the cross
    var trashLine1 = new Kinetic.Line({
        points: [-10, -10, 10, 10 ],
        stroke: 'red',
    });
    // second line of the cross
    var trashLine2 = new Kinetic.Line({
        points: [10, -10, -10, 10 ],
        stroke: 'red'
    });
    trash.add(trashLine1);
    trash.add(trashLine2);

    /**
     * Handle mouse down event.
     * @method mousedown
     * @param {Object} event The mouse down event.
     */
    this.mousedown = function(event){
        // determine if the click happened in an existing shape
        var stage = app.getDrawStage();
        var kshape = stage.getIntersection({
            x: event._xs, 
            y: event._ys
        });
        
        if ( kshape ) {
            var group = kshape.getParent();
            var selectedShape = group.find(".shape")[0];
            // reset editor if click on other shape
            // (and avoid anchors mouse down)
            if ( selectedShape && selectedShape !== shapeEditor.getShape() ) { 
                shapeEditor.disable();
                shapeEditor.setShape(selectedShape);
                shapeEditor.enable();
            }
        }
        else {
            // disable edition
            shapeEditor.disable();
            shapeEditor.setShape(null);
            // start storing points
            started = true;
            shapeGroup = new Kinetic.Group();
            // clear array
            points = [];
            // store point
            lastPoint = new BAMBOO.math.Point2D(event._x, event._y);
            points.push(lastPoint);
        }
    };

    /**
     * Handle mouse move event.
     * @method mousemove
     * @param {Object} event The mouse move event.
     */
    this.mousemove = function(event){
        if (!started)
        {
            return;
        }
        if ( Math.abs( event._x - lastPoint.getX() ) > 0 ||
                Math.abs( event._y - lastPoint.getY() ) > 0 )
        {
            // current point
            lastPoint = new BAMBOO.math.Point2D(event._x, event._y);
            points.push( lastPoint );
            // remove previous draw if not just started
            if ( activeShape && !justStarted ) {
                activeShape.destroy();
            }
            if ( justStarted ) {
                justStarted = false;
            }
            // create shape
            activeShape = new BAMBOO.tool.shapes[self.shapeName](points, self.style);
            // do not listen during creation
            activeShape.listening(false);
            app.getDrawLayer().hitGraphEnabled(false);
            // add shape to group
            shapeGroup.add(activeShape);
            // draw shape command
            command = new BAMBOO.tool.DrawShapeCommand(activeShape, self.shapeName, app);
            // draw
            command.execute();
        }
    };

    /**
     * Handle mouse up event.
     * @method mouseup
     * @param {Object} event The mouse up event.
     */
    this.mouseup = function (/*event*/){
        if (started && points.length > 1 )
        {
            // remove previous draw
            if ( activeShape ) {
                activeShape.destroy();
            }
            // create final shape
            activeShape = new BAMBOO.tool.shapes[self.shapeName](points, self.style);
            // re-activate layer
            app.getDrawLayer().hitGraphEnabled(true);
            // add shape to group
            shapeGroup.add(activeShape);
            // draw shape command
            command = new BAMBOO.tool.DrawShapeCommand(activeShape, self.shapeName, app);
            // execute it
            command.execute();
            // save it in undo stack
            app.getUndoStack().add(command);
            
            // set shape on
            self.setShapeOn(activeShape);
            createdShapes.push(activeShape);
        }
        // reset flag
        started = false;
        justStarted = true;
    };
    
    /**
     * Handle mouse out event.
     * @method mouseout
     * @param {Object} event The mouse out event.
     */
    this.mouseout = function(event){
        self.mouseup(event);
    };

    /**
     * Handle touch start event.
     * @method touchstart
     * @param {Object} event The touch start event.
     */
    this.touchstart = function(event){
        self.mousedown(event);
    };

    /**
     * Handle touch move event.
     * @method touchmove
     * @param {Object} event The touch move event.
     */
    this.touchmove = function(event){
        self.mousemove(event);
    };

    /**
     * Handle touch end event.
     * @method touchend
     * @param {Object} event The touch end event.
     */
    this.touchend = function(event){
        self.mouseup(event);
    };

    /**
     * Handle key down event.
     * @method keydown
     * @param {Object} event The key down event.
     */
    this.keydown = function(event){
        app.handleKeyDown(event);
    };

    /**
     * Enable the tool.
     * @method enable
     * @param {Boolean} flag The flag to enable or not.
     */
    this.display = function ( flag ){
        BAMBOO.gui.displayDrawHtml( flag );
        // reset shape display properties
        shapeEditor.disable();
        shapeEditor.setShape(null);
        document.body.style.cursor = 'default';
        // make layer listen or not to events
        app.getDrawStage().listening( flag );
        app.getDrawLayer().listening( flag );
        app.getDrawLayer().hitGraphEnabled( flag );
        // set shape display properties
        if ( flag ) {
            createdShapes.forEach( function (shape){ self.setShapeOn( shape ); });
        }
        else {
            createdShapes.forEach( function (shape){ setShapeOff( shape ); });
        }
        // draw
        app.getDrawLayer().draw();
    };
    
    /**
     * Set shape off properties.
     * @method setShapeOff
     * @param {Object} shape The shape to set off.
     */
    function setShapeOff( shape ) {
        // mouse styling
        shape.off('mouseover');
        shape.off('mouseout');
        // drag
        shape.draggable(false);
        shape.off('dragstart');
        shape.off('dragmove');
        shape.off('dragend');
    }

    /**
     * Get the real position from an event.
     */
    function getRealPosition( index ) {
        var stage = app.getDrawStage();
        return { 'x': stage.offset().x + index.x / stage.scale().x,
            'y': stage.offset().y + index.y / stage.scale().y };
    }
    
    /**
     * Set shape on properties.
     * @method setShapeOn
     * @param {Object} shape The shape to set on.
     */
    this.setShapeOn = function ( shape ) {
        // mouse over styling
        shape.on('mouseover', function () {
            document.body.style.cursor = 'pointer';
        });
        // mouse out styling
        shape.on('mouseout', function () {
            document.body.style.cursor = 'default';
        });

        // make it draggable
        shape.draggable(true);
        var dragStartPos = null;
        var dragLastPos = null;
        
        // command name based on shape type
        var cmdName = "shape";
        if ( shape instanceof Kinetic.Line ) {
            cmdName = "line";
        }
        else if ( shape instanceof Kinetic.Rect ) {
            cmdName = "rectangle";
        }
        else if ( shape instanceof Kinetic.Ellipse ) {
            cmdName = "ellipse";
        }
        
        // shape color
        var color = shape.stroke();
        
        // drag start event handling
        shape.on('dragstart', function (event) {
            // save start position
            var offset = BAMBOO.html.getEventOffset( event.evt )[0];
            dragStartPos = getRealPosition( offset );
            // display trash
            var stage = app.getDrawStage();
            var scale = stage.scale();
            var invscale = {'x': 1/scale.x, 'y': 1/scale.y};
            trash.x( stage.offset().x + ( 256 / scale.x ) );
            trash.y( stage.offset().y + ( 20 / scale.y ) );
            trash.scale( invscale );
            app.getDrawLayer().add( trash );
            // deactivate anchors to avoid events on null shape
            shapeEditor.setAnchorsActive(false);
            // draw
            app.getDrawLayer().draw();
        });
        // drag move event handling
        shape.on('dragmove', function (event) {
            var offset = BAMBOO.html.getEventOffset( event.evt )[0];
            var pos = getRealPosition( offset );
            dragLastPos = pos;
            // highlight trash when on it
            if ( Math.abs( pos.x - trash.x() ) < 10 &&
                    Math.abs( pos.y - trash.y() ) < 10   ) {
                trash.getChildren().each( function (tshape){ tshape.stroke('orange'); });
                shape.stroke('red');
            }
            else {
                trash.getChildren().each( function (tshape){ tshape.stroke('red'); });
                shape.stroke(color);
            }
            // reset anchors
            shapeEditor.resetAnchors();
            // draw
            app.getDrawLayer().draw();
        });
        // drag end event handling
        shape.on('dragend', function (/*event*/) {
            var pos = dragLastPos;
            // delete case
            if ( Math.abs( pos.x - trash.x() ) < 10 &&
                    Math.abs( pos.y - trash.y() ) < 10   ) {
                // compensate for the drag translation
                var delTranslation = {'x': pos.x - dragStartPos.x, 
                        'y': pos.y - dragStartPos.y};
                var group = this.getParent();
                group.getChildren().each( function (shape) {
                    shape.x( shape.x() - delTranslation.x );
                    shape.y( shape.y() - delTranslation.y );
                });
                // restore color
                shape.stroke(color);
                // disable editor
                shapeEditor.disable();
                shapeEditor.setShape(null);
                document.body.style.cursor = 'default';
                // delete command
                var delcmd = new BAMBOO.tool.DeleteShapeCommand(this, cmdName, app);
                delcmd.execute();
                app.getUndoStack().add(delcmd);
            }
            else {
                // save drag move
                var translation = {'x': pos.x - dragStartPos.x, 
                        'y': pos.y - dragStartPos.y};
                if ( translation.x !== 0 || translation.y !== 0 ) {
                    var mvcmd = new BAMBOO.tool.MoveShapeCommand(this, cmdName, translation, app);
                    app.getUndoStack().add(mvcmd);
                }
                // reset anchors
                shapeEditor.setAnchorsActive(true);
                shapeEditor.resetAnchors();
            }
            // remove trash
            trash.remove();
            // draw
            app.getDrawLayer().draw();
        });
    };


}; // Draw class

/**
 * Help for this tool.
 * @method getHelp
 * @returns {Object} The help content.
 */
BAMBOO.tool.Draw.prototype.getHelp = function()
{
    return {
        'title': "Draw",
        'brief': "Allows to draw shapes on the image. " +
            "Choose the shape and its color from the drop down menus. Once created, shapes " +
            "can be edited by selecting them. Anchors will appear and allow specific shape edition. " +
            "Drag the shape on the top red cross to delete it. All actions are undoable. ",
        'mouse': {
            'mouse_drag': "A single mouse drag draws the desired shape.",
        },
        'touch': {
            'touch_drag': "A single touch drag draws the desired shape.",
        }
    };
};

/**
 * Set the line color of the drawing.
 * @method setLineColour
 * @param {String} colour The colour to set.
 */
BAMBOO.tool.Draw.prototype.setLineColour = function(colour)
{
    // set style var
    this.style.setLineColor(colour);
};

/**
 * Set the shape name of the drawing.
 * @method setShapeName
 * @param {String} name The name of the shape.
 */
BAMBOO.tool.Draw.prototype.setShapeName = function(name)
{
    // check if we have it
    if( !this.hasShape(name) )
    {
        throw new Error("Unknown shape: '" + name + "'");
    }
    this.shapeName = name;
};

/**
 * Check if the shape is in the shape list.
 * @method hasShape
 * @param {String} name The name of the shape.
 */
BAMBOO.tool.Draw.prototype.hasShape = function(name) {
    return BAMBOO.tool.shapes[name];
};

/**
 * Initialise the tool.
 * @method init
 */
BAMBOO.tool.Draw.prototype.init = function() {
    // set the default to the first in the list
    var shapeName = 0;
    for( var key in BAMBOO.tool.shapes ){
        shapeName = key;
        break;
    }
    this.setShapeName(shapeName);
    // same for color
    this.setLineColour(BAMBOO.tool.colors[0]);
    // init html
    //BAMBOO.gui.initDrawHtml();
};
