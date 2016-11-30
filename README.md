# gbt (Groebner basis tests)

Testing of Grobner basis implementations is an important part of
making algorithms more effective. The `gbt' package is a lightweight tool
to support this task.

**gbt** is designed to do benchmarking for any computer algebra systems
which can be started by an executable. The well known computer algebra
systems *Maxima*, *Singular* and *Giac* are supported out of the box.
Other systems like *CoCoA*, *JAS*, *Reduce* are also supported but they
may be installed from source at the moment, and may require some fine
tuning.

## Installation

### Prerequisites

You need PHP on your workstation which is preferably a Linux server with
Ubuntu 16.04 and PHP 7 installed.

The benchmarks can be run either from command line or a web browser.
In the latter case you will need a piece of web server software
for that---the simplest choice is Apache.

If you use Apache, you may want to turn on userdir support and
allow the users to run PHP scripts in their userdir. See
[Ubuntu's guide] (https://wiki.ubuntu.com/UserDirectoryPHP) for some hints
on this.

If you are under Ubuntu, please install the packages *maxima*,
*singular* and *giac* (for Giac you need to follow
[the official guide] (http://www-fourier.ujf-grenoble.fr/~parisse/install_en#packages)
to add the repository first).

### Installing gbt for Apache/PHP/userdir

We assume that you chose userdir installation above for the user _joe_.
Now you will create the folder /home/__joe__/public_html/gbtest/
by copying the content of the folder __gbtest/__ from the gbt project.

Then, please change the folder tests/ and benchmark/ in the gbtest/ folder
to world writable:

    $ cd ~/public_html/gbtest/
    $ chmod 1777 tests/ benchmark/

Now by pointing your browser to http://IP.OF.YOUR.SERVER/~joe/gbtest/
you should see the following:

(/gbt-index.png)

By filling in the form with the provided example, and submitting it,
the following is what you should expect:

(/gbt-monitoring.png)

The output of each computer algebra system should be an ideal with the
element `1'. For example, in Maxima something like this should be shown
after clicking on the text `finished':

    Maxima 5.37.2 http://maxima.sourceforge.net
    using Lisp GNU Common Lisp (GCL) GCL 2.6.12
    Distributed under the GNU Public License. See the file COPYING.
    Dedicated to the memory of William Schelter.
    The function bug_report() provides bug reporting information.
    (%i1) (%o3)                                 [1]
    (%i4) 

## Configuration and next steps

Now you can go back to http://IP.OF.YOUR.SERVER/~joe/gbtest/
and please click on the link __documentation__ for further details.
